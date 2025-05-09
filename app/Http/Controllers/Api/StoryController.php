<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Imagetype;
use Emutoday\Story;
use Emutoday\User;
use Emutoday\Author;
use Carbon\Carbon;

use Illuminate\Support\Facades\Request as Input;
use Illuminate\Http\Request;


use Emutoday\Today\Transformers\FractalStoryTransformerModel;

use League\Fractal\Manager;
use League\Fractal;


class StoryController extends ApiController
{
  /**
   * @var emutoday\Emutoday\Transformers\StoryTransformer
   */
  protected $story;

  function __construct(Story $story) {
    $this->story = $story;
    $this->middleware('web', ['only' => ['queueload', 'queue'
    ]]);
  }


  public function queue($gtype, $stype, $qtype, $fromDate = null, $toDate = null) {
    if (\Auth::check()) {
      $user = \Auth::user();
      if ($user->hasRole('contributor_1')) {
        if ($fromDate && !$toDate) {
          $storys = $user->storys()->where([['start_date', '>=', $fromDate], ['is_archived', 0]])->get();
        } elseif ($fromDate && $toDate) {
          $storys = $user->storys()->where('is_archived', 0)->whereBetween('start_date', array($fromDate, $toDate))->get();
        } else {
          $storys = $user->storys()->where('is_archived', 0)->get();
        }
      } else {
        if ($qtype === 'queueall') {
          if ($fromDate && !$toDate) {
            $storys = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0]])->get();
          } elseif ($fromDate && $toDate) {
            $storys = Story::where('is_archived', 0)->whereBetween('start_date', array($fromDate, $toDate))->get();
          } else {
            $storys = Story::where('is_archived', 0)->get();
          }

        } else {
          if ($fromDate && !$toDate) {
            $storys = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['story_type', $stype]])->get();
          } elseif ($fromDate && $toDate) {
            $storys = Story::where(['story_type' => $stype, 'is_archived' => 0])->whereBetween('start_date', array($fromDate, $toDate))->get();
          } else {
            $storys = Story::where('is_archived', 0)->get();
          }
        }
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryTransformerModel);
      // Turn all of that into a Array string
      return $fractal->createData($resource)->toArray();
    } else {
      return $this->setStatusCode(501)->respondWithError('Error');
    }
  }

  public function queueload($stype) {
    if (\Auth::check()) {
      $user = \Auth::user();
      if ($user->hasRole('contributor_1')) {
        $storys = $user->storys()->get();
      } else {
        if ($stype === 'all') {
          $storys = Story::get();
        } else {
          $storys = Story::where('story_type', $stype)->get();
        }
      }
      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryTransformerModel);
      // Turn all of that into a Array string
      return $fractal->createData($resource)->toArray();
    } else {
      return $this->setStatusCode(501)->respondWithError('Error');

    }
  }

  public function listType($stype) {

    if (\Auth::check()) {
      $user = \Auth::user();
      if ($user->hasRole('contributor_1')) {
        // dd($user->id);
        if ($stype == 'all') {
          $storys = $user->storys()->get();
        } else {
          $storys = $user->storys()->where('story_type', $stype)->get();
        }
      } else {
        if ($stype == 'all') {
          $storys = Story::get();
        } else {
          $storys = Story::where('story_type', $stype)->get();
        }
      }
      $fractal = new Manager();
      // $storys = Story::all();
      $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryExtraTransformer);
      // Turn all of that into a Array string
      return $fractal->createData($resource)->toJson();
    } else {
      return $this->setStatusCode(501)->respondWithError('Error');

    }
  }

  public function listApproved() {
    $fractal = new Manager();

    $storys = Story::where('is_approved', 1)->get();


    $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryTransformer);
    // Turn all of that into a JSON string
    return $fractal->createData($resource)->toArray();
  }

  public function articles() {
    $fractal = new Manager();

    $storys = Story::where('story_type', 'article')->get();

    $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryTransformer);
    return $fractal->createData($resource)->toArray();
  }

  public function store(Request $request) {
    if ($request->get('story_type') == 'featurephoto') {
      $photo_credit = $request->get('photo_credit');
      $validation = \Validator::make(Input::all(), [
          'title' => 'required',
          'start_date' => 'required',
          'story_type' => 'required',
          'photo_credit' => 'required',
          'user_id' => 'required']);
    } else {
      $photo_credit = null;
      $validation = \Validator::make(Input::all(), [
          'title' => 'required',
          'start_date' => 'required',
          'story_type' => 'required',
          'content' => 'required',
          'user_id' => 'required']);
    }

    if ($validation->fails()) {
      return $this->setStatusCode(422)
          ->respondWithError($validation->errors()->getMessages());
    }

    if ($validation->passes()) {
      $defaultContact = $this->getCurrentPrimaryContact(); // the default primary contact if none specified in the story.
      $request->get('contact_id') != '' ? $contact_id = $request->get('contact_id') : $contact_id = $defaultContact->id;

      // People like Walter and Geoff should have an 'auto_approved' role set for them.
      $auto_approve = $this->isAutoApproved($request->get('user_id'), $request->get('story_type'));
      if ($auto_approve) {
        $approval_level = 1;
      } else {
        $approval_level = 0;
      }

      $story = new Story;
      $story->title = $request->get('title');
      $story->slug = $request->get('slug');
      $story->subtitle = $request->get('subtitle');
      $story->teaser = $request->get('teaser');
      $story->story_type = $request->get('story_type');
      $story->user_id = $request->get('user_id');
      $story->content = $request->get('content');
      $story->start_date = \Carbon\Carbon::parse($request->get('start_date'));
      $story->author_id = $request->get('author_id', $request->get('story_type') == 'statement' ? 35 : 0);
      $story->photo_credit = $photo_credit;
      $story->contact_id = $contact_id;
      $story->is_approved = $approval_level;

      //Somehow, 'news' story type does this automatically...not sure how though. CP 9/7/17
      if ($request->get('story_type') == 'advisory' || $request->get('story_type') == 'statement') {
        $story->is_ready = 1;
      }
      $tags = array_pluck($request->input('tags'), 'value');

      if ($story->save()) {
        $record_id = $story->id;

        $newStory = Story::find($record_id);
        $newStory->tags()->sync($tags);

        $newStory->save();

        return $this->setStatusCode(201)
            ->respondSavedWithData('Story has been created.', ['record_id' => $story->id, 'stype' => $story->story_type]);
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    $story = Story::find($id);

    if (!$story) {
      return $this->respondNotFound('Story Does Not Exist!');
    }

    return $this->respond([
        'data' => $this->storyTransformer->transform($story)

    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $fractal = new Manager();
    $story = Story::findOrFail($id);
    $resource = new Fractal\Resource\Item($story, new FractalStoryTransformerModel);
    // Turn all of that into a JSON string
    return $fractal->createData($resource)->toArray();
  }

  /**
   * [API Call from StoryItem to change some variables]
   * @param  [type]  $id      [description]
   * @param Request $request [description]
   * @return [type]           [description]
   */
  public function updateItem($id, Request $request) {
    if (\Auth::check()) {
      $user = \Auth::user();
      if ($user->hasRole('admin')) {
        $story = Story::findOrFail($id);
        $story->is_approved = $request->get('is_approved', 0);
        $story->priority = $request->get('priority', 0);
        $story->is_archived = $request->get('is_archived', 0);

        if ($story->save()) {
          $returnData = ['is_approved' => $story->is_approved, 'priority' => $story->priority, 'is_archived' => $story->is_archived];
          return $this->setStatusCode(201)
              ->respondUpdatedWithData('story patched', $returnData);
        }
      } else {
        return false;
      }
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $story = $this->story->findOrFail($id);

    if ($request->get('story_type') == 'featurephoto') {
      $photo_credit = $request->get('photo_credit');
      $validation = \Validator::make(Input::all(), [
          'title' => 'required',
          'start_date' => 'required',
          'story_type' => 'required',
          'photo_credit' => 'required',
          'user_id' => 'required']);
    } else {
      $photo_credit = null;
      $validation = \Validator::make(Input::all(), [
          'title' => 'required',
          'start_date' => 'required',
          'story_type' => 'required',
          'content' => 'required',
          'user_id' => 'required']);
    }

    if ($validation->fails()) {
      return $this->setStatusCode(422)
          ->respondWithError($validation->errors()->getMessages());
    }
    if ($validation->passes()) {
      $defaultContact = $this->getCurrentPrimaryContact(); // the default primary contact if none specified in the story.
      $request->get('contact_id') != '' ? $contact_id = $request->get('contact_id') : $contact_id = $defaultContact->id;

      $story->title = $request->get('title');
      $story->slug = $request->get('slug');
      $story->subtitle = $request->get('subtitle');
      $story->teaser = $request->get('teaser');
      $story->story_type = $request->get('story_type');
      $story->author_id = $request->get('author_id', $request->get('story_type') == 'statement' ? 35 : 0);
      $story->author_info = $request->get('author_info', null);
      $story->photo_credit = $photo_credit;
      $story->content = $request->get('content');
      $story->is_approved = $request->get('is_approved', 0);
      $story->is_promoted = $request->get('is_promoted', 0);
      $story->is_featured = $request->get('is_featured', 0);
      $story->is_live = $request->get('is_live', 0);
      $story->is_archived = $request->get('is_archived', 0);
      $story->start_date = $request->get('start_date');
      $story->end_date = \Carbon\Carbon::parse($request->get('end_date', null));
      $story->contact_id = $contact_id;

      $tags = array_pluck($request->input('tags'), 'value');
      $story->tags()->sync($tags);

      if ($story->update()) {
        $record_id = $story->id;

        return $this->setStatusCode(201)
            ->respondSavedWithData('Story updated.', ['record_id' => $record_id, 'stype' => $story->story_type, 'ready' => $story->is_ready]);
      }
    }

  }

  public function updateQueue(Request $request) {
    $isGood = false;
    $msg = '';
    $story = $this->story->findOrFail($request->get('id'));
    if ($request->get('xIs_approved') === 1) {
      if ($story->story_type === 'news') {
        $story->is_approved = 1;
        $isGood = true;
        $msg = 'story approved!';
      } else {
        if ($story->is_promoted === 1) {
          $story->is_approved = 1;
          $isGood = true;
          $msg = 'story approved!';
        } else {
          $isGood = false;
          $msg = 'Story needs to be promoted before approved';
        }
      }
    } elseif ($request->get('xIs_approved') === 0) {
      $story->is_approved = 0;
      $isGood = true;
      $msg = 'story is now unapproved!';
    } else {
      $isGood = false;
      $msg = 'unknown error';
    }

    if ($isGood) {
      if ($story->save()) {
        return $this->setStatusCode(201)
            ->respond(['isapproved' => $story->is_approved, 'msg' => $msg]);
      }
    } else {
      return $this->setStatusCode(422)
          ->respondWithError([$msg]);

    }

  }

  /**
   * [API Call from AnnouncementItem to change some variables]
   * @param  [type]  $id      [description]
   * @param Request $request [description]
   * @return [type]           [description]
   */
  public function archiveItem($id, Request $request) {
    $story = Story::findOrFail($id);
    $story->is_approved = $request->get('is_approved', 0);
    $story->priority = 0; // archived stories lose their priority
    $story->is_archived = 1;


    if ($story->save()) {

      $returnData = ['is_approved' => $story->is_approved, 'priority' => $story->priority, 'is_archived' => $story->is_archived];
      return $this->setStatusCode(201)
          ->respondUpdatedWithData('Story archived', $returnData);
    }
  }

  public function delete(Request $request) {
    $story = $this->story->findOrFail($request->get('id'));
    $story->delete();
    flash()->warning('Story has been deleted.');
    return redirect(route('admin.story.index'));//->with('status', 'Story has been deleted.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
  }

  public function getAuthorData(Author $author, $id) { //
    return $author->findOrFail($id);
  }

  public function storeAuthor(Request $request) { // new author
    $validation = \Validator::make(Input::all(), [
        'first_name' => 'required',
    ]);
    if ($validation->fails()) {
      return $this->setStatusCode(422)
          ->respondWithError($validation->errors()->getMessages());
    }
    if ($validation->passes()) {
      $author = new Author;
      $author->first_name = $request->get('first_name');
      $author->last_name = $request->get('last_name', null);
      $author->email = $request->get('email', null);
      $author->phone = $request->get('phone', null);

      if ($author->save()) {
        return $this->setStatusCode(201)
            ->respondSavedWithData("Author has been saved", ['author' => $author]);
      }
    }
  }

  public function saveAuthor(Request $request, $id, Author $a) { // patch author
    $author = $a->findOrFail($id);
    $validation = \Validator::make(Input::all(), [
        'first_name' => 'required',
    ]);
    if ($validation->fails()) {
      return $this->setStatusCode(422)
          ->respondWithError($validation->errors()->getMessages());
    }
    if ($validation->passes()) {
      $author->first_name = $request->get('first_name');
      $author->last_name = $request->get('last_name', null);
      $author->email = $request->get('email', null);
      $author->phone = $request->get('phone', null);

      if ($author->save()) {
        $author->save();
        return $this->setStatusCode(201)
            ->respondSavedWithData("Author has been saved", ['author' => $author]);
      }
    }
  }

  /**
   *  Get the one user in the authors table set as the PRINCIPAL contact
   */
  public function getCurrentPrimaryContact() {
    $author = Author::select()->where('is_principal_contact', 1)->first();

    return $author;
  }

  /**
   * Determine if the currently logged-in user has the auto_approved role.
   * If so, and if the story type is "news" "advisory" or "statement", return true.
   *
   * @param int $user_id The ID of the user.
   * @param string $story_type The type of story.
   * @return boolean $isApproved
   */
  public function isAutoApproved($user_id, $story_type) {
    $user = User::findOrFail($user_id);

    if ($story_type == 'news' || $story_type == 'advisory' || $story_type == 'statement') {
      foreach ($user->roles()->get() as $role) {
        if ($role->name == 'auto_approved') {
          return true;
        }
      }
    }
    return false;
  }

  /**
   * Any story with a 'priority' > 0
   */
  public function getElevatedStorys() {
    $currentDate = Carbon::now();
    if (\Auth::check()) {

      $user = \Auth::user();
      if ($user->hasRole('contributor_1')) {
        return $this->setStatusCode(401)->respondWithError('You do not have sufficient privileges to see elevated stories.');
      } else {
        $stories = Story::where([['priority', '>', 0]])->orderBy('priority', 'desc')->get();
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($stories->all(), new FractalStoryTransformerModel);
      // Turn all of that into a Array string
      return $fractal->createData($resource)->toArray();

    } else {
      return $this->setStatusCode(501)->respondWithError('Error');
    }
  }

  /**
   * Takes in elevated stories and re-arranges their priority in array order.
   */
  public function reorderElevatedStorys(Request $request) {
    $elevatedStories = $request->all();

    $elevatedStoryIds = array();
    for ($i = 0; $i < count($elevatedStories); $i++) {
      $story = Story::findOrFail($elevatedStories[$i]['id']);
      $story->priority = count($elevatedStories) - $i; //set new priority
      $story->save();
      $elevatedStoryIds[] = $story->id; //prevent this story's priority from being set to 0
    }

    // Set all other announcement priorities to 0
    Story::whereNotIn('id', $elevatedStoryIds)->update(['priority' => 0]);

    // Get updated list of priority announcements
    $stories = Story::where([['priority', '>', 0]])->orderBy('priority', 'desc')->get();
    $fractal = new Manager();
    $resource = new Fractal\Resource\Collection($stories->all(), new FractalStoryTransformerModel);
    // Turn all of that into a Array string
    return $fractal->createData($resource)->toArray();
  }

  /**
   * These stories are emustory type that have the emutoday_175 image type
   * @param Request $request
   * @param $fromDate
   * @param $toDate
   * @return \Illuminate\Http\JsonResponse
   */
  public function getEmu175Stories(Request $request, $fromDate = null, $toDate = null) {
    $emu175ImageTypeIds = Imagetype::select('id')->where('type', 'emu175')->get(); // get email image types

    if ($fromDate && !$toDate) {
      $stories = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->whereHas('images', function ($query) use ($emu175ImageTypeIds) {
        $query->whereIn('imagetype_id', $emu175ImageTypeIds);
      })->orderBy('start_date', 'desc')->get();
    } else if ($fromDate && $toDate) {
      $stories = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->whereBetween('start_date', array($fromDate, $toDate))->whereHas('images', function ($query) use ($emu175ImageTypeIds) {
        $query->whereIn('imagetype_id', $emu175ImageTypeIds);
      })->orderBy('start_date', 'desc')->get();
    } else {
      $stories = Story::where([['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->whereHas('images', function ($query) use ($emu175ImageTypeIds) {
        $query->whereIn('imagetype_id', $emu175ImageTypeIds);
      })->orderBy('start_date', 'desc')->get();
    }

    $fractal = new Manager();
    $resource = new Fractal\Resource\Collection($stories->all(), new FractalStoryTransformerModel);

    return $this->setStatusCode(200)
        ->respondUpdatedWithData('Got stories with emutoday_175 image type.', $fractal->createData($resource)->toArray());
  }

  public function updateEmu175Story(Request $request) {
    $story_id = $request->get('id');
    // Set the story as an emu175 hub story
    if($story_id) {
      $story = Story::findOrFail($story_id);
      $story->is_emu175_hub_story = 1;
      $story->save();
    }
    // Remove the current emu175 hub story (if any)
    $stories = Story::where('is_emu175_hub_story', 1)->get();
    foreach($stories as $s) {
      // Don't unset the one that was just set!
      if($s->id != $story_id) {
        $s->is_emu175_hub_story = 0;
        $s->save();
      }
    }

    return $this->setStatusCode(201)
          ->respondUpdatedWithData('EMU 175 story set!', []);
  }
}
