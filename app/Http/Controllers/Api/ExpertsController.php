<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Expert;
use Emutoday\ExpertCategory;
use Emutoday\ExpertEducation;
use Emutoday\ExpertExpertise;
use Emutoday\ExpertLanguages;
use Emutoday\ExpertSocial;
use Emutoday\ExpertTitles;
use Emutoday\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Request as Input;
use Carbon\Carbon;

use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalExpertTransformerModel;

class ExpertsController extends ApiController
{
  function __construct()
  { //
  }

  public function getExperts(Request $request, $id = null){
      if($id){
            $result = Expert::select('last_name', 'first_name', 'id')->where('id', $id)->get();
      } else {
          // Return different results based on the GET param sent (some experts are media only, community speak only, or neither/both)
          if($request->get('type') == 'media'){
              $result = Expert::select('last_name', 'first_name', 'id')->where(['is_media_expert' => 1, 'is_approved' => 1])->orderBy('last_name', 'asc')->get();
          } else if($request->get('type') == 'speaker') {
              $result = Expert::select('last_name', 'first_name', 'id')->where(['is_community_speaker' => 1, 'is_approved' => 1])->orderBy('last_name', 'asc')->get();
          } else {
              $result = Expert::select('last_name', 'first_name', 'id')->where('is_approved', 1)->orderBy('last_name', 'asc')->get();
          }
      }

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got expert(s)', $result );
  }

  /**
   * Get all the experts based on the search term.
   */
  public function searchExperts(Request $request, $term = ''){
        if($term != ''){
            $result = Expert::orderBy('last_name', 'asc')
              ->where(function ($query) use ($term){
                $query->where('first_name', 'like', '%'. $term . '%')
                      ->orWhere('last_name', 'like', '%'. $term .'%');
              });
            if($request->get('type_filter') == 'unapproved'){
              $result = $result->where('is_approved', 0)->whereRaw('created_at != updated_at');
            }
            if($request->get('type_filter') == 'new'){
              $result = $result->where('is_approved', 0)->whereRaw('created_at = updated_at');
            }
            $result = $result->with('expertImages')->paginate(10);
        } else {
            $result = Expert::orderBy('last_name', 'asc');
            if($request->get('type_filter') == 'unapproved'){
              $result = $result->where('is_approved', 0)->whereRaw('created_at != updated_at');
            }
            if($request->get('type_filter') == 'new'){
              $result = $result->where('is_approved', '=', 0)->whereRaw('created_at = updated_at');
            }
            $result = $result->with('expertImages')->paginate(10);
        }

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got expert(s)', $result );
  }

  /**
   * Create and save a new expert
   */
  public function store(Request $request)
  {

    $validation = \Validator::make( Input::all(), [
        'first_name'          => 'required|max:80|min:2',
        'last_name'           => 'required|max:80|min:2',
        'title'               => 'required',
        'biography'           => 'required',
        'display_name'        => 'required',
        'email'               => 'required',
        'accept_policies'     => 'accepted',
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
        Cas::authenticate(); //run authentication before calling cas->user
        $expert = new Expert;
        $expert->submitter_username         = Cas::user();

        $expert->first_name                 = $request->get('first_name');
        $expert->last_name      	        = $request->get('last_name');
        $expert->title      	            = $request->get('title');
        $expert->biography     	            = $request->get('biography');
        $expert->teaser     	            = $request->get('teaser');
        $expert->display_name     	        = $request->get('display_name');
        $expert->is_community_speaker       = (int) $request->get('is_community_speaker', 0); //elasticsearch requires 1 or 0 instead of true or false
        $expert->is_media_expert            = (int) $request->get('is_media_expert', 0);
        $expert->do_print_interviews        = (int) $request->get('do_print_interviews', 0);
        $expert->do_broadcast_interviews    = (int) $request->get('do_broadcast_interviews', 0);
        $expert->office_phone               = $request->get('office_phone');
        $expert->cell_phone                 = $request->get('cell_phone');
        $expert->release_cell_phone         = $request->get('release_cell_phone');
        $expert->email                      = $request->get('email');
        $expert->is_approved                = (int) $request->get('is_approved', 0);
        $expert->submitter_name             = $request->get('submitter_name');
        $expert->submitter_email            = $request->get('submitter_email');
        $expert->submitter_phone            = $request->get('submitter_phone');
        $expert->accept_policies            = 1;

        if($expert->save()) {

          $categories = array_pluck($request->input('categories'),'value');
          $expert->expertCategories()->sync($categories);

          $this->syncExistingTitles($expert->id, $request->input('previousTitles'));
          $this->syncEducation($expert->id, $request->input('education'));
          $this->syncExpertise($expert->id, $request->input('expertise'));
          $this->syncLanguages($expert->id, $request->input('languages'));
          $this->syncSocialMediaLinks($expert->id, $request->input('social'));

          return $this->setStatusCode(201)
          ->respondSavedWithData('Expert successfully saved!',[ 'record_id' => $expert->id ]);
        }
    }
  }

  public function edit($id)
  {
    $fractal = new Manager();
    $expert = Expert::findOrFail($id);

    $resource = new Fractal\Resource\Item($expert, new FractalExpertTransformerModel);
    // Turn all of that into a JSON string
    return $fractal->createData($resource)->toArray();
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $expert = Expert::findOrFail($id);

    $validation = \Validator::make( Input::all(), [
      'first_name'          => 'required|max:80|min:2',
      'last_name'           => 'required|max:80|min:2',
      'title'               => 'required',
      'biography'           => 'required',
      'display_name'        => 'required',
      'email'               => 'required'
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
        $expert->first_name                 = $request->get('first_name');
        $expert->last_name      	        = $request->get('last_name');
        $expert->title      	            = $request->get('title');
        $expert->biography     	            = $request->get('biography');
        $expert->teaser     	            = $request->get('teaser');
        $expert->display_name     	        = $request->get('display_name');
        $expert->is_community_speaker       = (int) $request->get('is_community_speaker', 0); //elasticsearch requires 1 or 0 instead of true or false
        $expert->is_media_expert            = (int) $request->get('is_media_expert', 0);
        $expert->do_print_interviews        = (int) $request->get('do_print_interviews', 0);
        $expert->do_broadcast_interviews    = (int) $request->get('do_broadcast_interviews', 0);
        $expert->office_phone               = $request->get('office_phone');
        $expert->cell_phone                 = $request->get('cell_phone');
        $expert->release_cell_phone         = $request->get('release_cell_phone');
        $expert->email                      = $request->get('email');
        $expert->is_approved                = (int) $request->get('is_approved', 0);
        $expert->submitter_name             = $request->get('submitter_name');
        $expert->submitter_email            = $request->get('submitter_email');
        $expert->submitter_phone            = $request->get('submitter_phone');

        $categories = array_pluck($request->input('categories'),'value');
        $expert->expertCategories()->sync($categories); //sync only works with many-to-many relationships, not one-to-many

        $this->syncExistingTitles($expert->id, $request->input('previousTitles'));
        $this->syncEducation($expert->id, $request->input('education'));
        $this->syncExpertise($expert->id, $request->input('expertise'));
        $this->syncLanguages($expert->id, $request->input('languages'));
        $this->syncSocialMediaLinks($expert->id, $request->input('social'));

        if($expert->save()) {
            return $this->setStatusCode(201)
            ->respondSavedWithData('Expert successfully updated!',[ 'record_id' => $expert->id ]);
        }
    }
  }

  protected function syncExistingTitles($id, $previousTitles = array()){
      $expert = Expert::findOrFail($id);

      //Find any deleted titles by comparing the IDs of what's in the database now to what was send back from the form
      $existingTitleIds = $expert->previousTitles()->pluck('id')->toArray();
      $updatedTitleIds = array_pluck($previousTitles,'value');
      $diffTitles = array_diff($existingTitleIds, $updatedTitleIds);
      ExpertTitles::destroy($diffTitles);

      // Update previous titles that match this expert (prior to update)
      $updatedTitles = $previousTitles;
      foreach($updatedTitles as $updatedTitle){
          $title        = ExpertTitles::find($updatedTitle['value']);

          // Some titles in the array will be new and won't have an ID. Skip these here.
          if($title){
              $title->title = $updatedTitle['title'];
              $title->save();
          }
          // Now add any new titles
          else {
              $newTitle               = new ExpertTitles;
              $newTitle->title        = $updatedTitle['title'];
              $newTitle->expert_id    = $expert->id;
              $newTitle->save();
          }
      }

      return true;
  }

  protected function syncEducation($id, $previousEducation = array()){
      $expert = Expert::findOrFail($id);

      //Find any deleted titles by comparing the IDs of what's in the database now to what was send back from the form
      $existingEducationIds = $expert->education()->pluck('id')->toArray();
      $updatedEducationIds = array_pluck($previousEducation,'value');
      $diffEducation = array_diff($existingEducationIds, $updatedEducationIds);
      ExpertEducation::destroy($diffEducation);

      // Update previous education that match this expert (prior to update)
      $updatedEducation = $previousEducation;
      foreach($updatedEducation as $updatedEd){
          $education        = ExpertEducation::find($updatedEd['value']);

          // Some titles in the array will be new and won't have an ID. Skip these here.
          if($education){
              $education->education = $updatedEd['education'];
              $education->save();
          }
          // Now add any new titles
          else {
              $newEducation               = new ExpertEducation;
              $newEducation->education    = $updatedEd['education'];
              $newEducation->expert_id    = $expert->id;
              $newEducation->save();
          }
      }

      return true;
  }

  protected function syncExpertise($id, $previousExpertise = array()){
      $expert = Expert::findOrFail($id);

      //Find any deleted titles by comparing the IDs of what's in the database now to what was send back from the form
      $existingExpertiseIds = $expert->expertise()->pluck('id')->toArray();
      $updatedExpertiseIds = array_pluck($previousExpertise,'value');
      $diffExpertise = array_diff($existingExpertiseIds, $updatedExpertiseIds);
      ExpertExpertise::destroy($diffExpertise);

      // Update previous fields of expertise that match this expert (prior to update)
      $updatedExpertise = $previousExpertise;
      foreach($updatedExpertise as $updatedExp){
          $expertise        = ExpertExpertise::find($updatedExp['value']);

          // Some titles in the array will be new and won't have an ID. Skip these here.
          if($expertise){
              $expertise->expertise = $updatedExp['expertise'];
              $expertise->save();
          }
          // Now add any new fields of expertise
          else {
              $newExpertise              = new ExpertExpertise;
              $newExpertise->expertise   = $updatedExp['expertise'];
              $newExpertise->expert_id    = $expert->id;
              $newExpertise->save();
          }
      }

      return true;
  }

  protected function syncLanguages($id, $previousLanguages = array()){
      $expert = Expert::findOrFail($id);

      //Find any deleted titles by comparing the IDs of what's in the database now to what was send back from the form
      $existingLanguageIds = $expert->languages()->pluck('id')->toArray();
      $updatedLanguageIds = array_pluck($previousLanguages,'value');
      $diffLanguages = array_diff($existingLanguageIds, $updatedLanguageIds);
      ExpertLanguages::destroy($diffLanguages);

      // Update previous languages that match this expert (prior to update)
      $updatedLanguages = $previousLanguages;
      foreach($updatedLanguages as $updatedLanguage){
          $language        = ExpertLanguages::find($updatedLanguage['value']);

          // Some titles in the array will be new and won't have an ID. Skip these here.
          if($language){
              $language->language = $updatedLanguage['language'];
              $language->save();
          }
          // Now add any new titles
          else {
              $newLanguage               = new ExpertLanguages;
              $newLanguage->language     = $updatedLanguage['language'];
              $newLanguage->expert_id    = $expert->id;
              $newLanguage->save();
          }
      }

      return true;
  }

    protected function syncSocialMediaLinks($id, $previousSocial = array()){
        $expert = Expert::findOrFail($id);

        //Find any deleted titles by comparing the IDs of what's in the database now to what was send back from the form
        $existingSocialIds = $expert->socialMediaLinks()->pluck('id')->toArray();
        $updatedSocialIds = array_pluck($previousSocial,'value');
        $diffSocial = array_diff($existingSocialIds, $updatedSocialIds);
        ExpertSocial::destroy($diffSocial);

        // Update previous social media links that match this expert (prior to update)
        $updatedSocial = $previousSocial;
        foreach($updatedSocial as $updatedSoc){
            $social        = ExpertSocial::find($updatedSoc['value']);

            // Some titles in the array will be new and won't have an ID. Skip these here.
            if($social){
                $social->title = $updatedSoc['title'];
                $social->url   = $updatedSoc['url'];
                $social->save();
            }
            // Now add any new links
            else {
                $newSocial               = new ExpertSocial;
                $newSocial->title        = $updatedSoc['title'];
                $newSocial->url          = $updatedSoc['url'];
                $newSocial->expert_id    = $expert->id;
                $newSocial->save();
            }
        }

        return true;
    }

  /**
   * Get expert categories. If there is an ID, get only the categories associated with that expert. If not, get all categories.
   *
   * @param int $id
   * @return array
   */
  public function expertCategory($id = null){
      if($id){
          $expert = Expert::findOrFail($id);
          $category = $expert->expertCategories()->select('category', 'id as value')->get();
          return $category;
      }
      $categories = ExpertCategory::select('category', 'id as value')->orderBy('category', 'asc')->get();
      return $categories;
  }

  /**
   * Get a list of an expert's education.
   *
   * @param int $id
   * @return array
   */
  public function expertEducation($id){
      $education = ExpertEducation::select('education', 'id as value')->where('expert_id', $id)->orderBy('education', 'asc')->get();
      return $education;
  }

  /**
   * Get a list of an expert's fields of expertise.
   *
   * @param int $id
   * @return array
   */
  public function expertExpertise($id){
      $expertise = ExpertExpertise::select('expertise', 'id as value')->where('expert_id', $id)->orderBy('expertise', 'asc')->get();
      return $expertise;
  }

  /**
   * Get a list of an expert's languages.
   *
   * @param int $id
   * @return array
   */
  public function expertLanguages($id){
      $languages = ExpertLanguages::select('language', 'id as value')->where('expert_id', $id)->orderBy('language', 'asc')->get();
      return $languages;
  }

  /**
   * Get a list of an expert's previous job titles.
   *
   * @param int $id
   * @return array
   */
  public function expertPreviousTitles($id){
      $titles = ExpertTitles::select('title', 'id as value')->where('expert_id', $id)->orderBy('title', 'asc')->get();
      return $titles;
  }

  /**
   * Get a list of an expert's social media links.
   *
   * @param int $id
   * @return array
   */
  public function expertSocialMediaLinks($id){
      $social = ExpertSocial::select('title', 'url', 'id as value')->where('expert_id', $id)->orderBy('title', 'asc')->get();
      return $social;
  }

  /**
   * Delete an expert.
   *
   * @param int $id
   * @return array
   */
  public function delete($id)
  {
    $expert = Expert::findOrFail($id);
    $expert->delete();
    return $this->setStatusCode(200)->respond('Expert successfully deleted!');
  }
}
