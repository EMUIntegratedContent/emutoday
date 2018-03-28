<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Emutoday\Expert;
use Emutoday\ExpertCategory;
use Illuminate\Http\Request;

use Carbon\Carbon;
use JavaScript;


class ExpertsController extends Controller
{
  protected $expert; // Disabled because I wanted to use POST request

  public function __construct(Expert $expert)
  {
    $this->expert = $expert;
    $this->middleware('auth', ['only'=>['expertForm', 'userExperts']]);
  }

  /**
   * Index page of experts system. Visible to public.
   */
  public function index()
  {
      $expertCategories = ExpertCategory::all();
      return view('public.experts.index', compact('expertCategories'));
  }

  /**
   * Show an individual expert's page
   */
  public function show($id){
      $expert = Expert::findOrFail($id);

      // Need to generate a comma-separated string of expertise where last item has comma stripped off
      $expertise_arr = array();
      foreach($expert->expertise as $expertise){
          $expertise_arr[] = $expertise->expertise;
      }
      $expertiseString = implode(', ', $expertise_arr);

      // Need to generate a comma-separated string of languages where last item has comma stripped off
      $language_arr = array();
      foreach($expert->languages as $language){
          $language_arr[] = $language->language;
      }
      if(count($language_arr) > 0){
          $languageString = '<p><i class="fa fa-globe"></i> This expert also speaks: ' . implode(', ', $language_arr) . '</p>';
      } else {
          $languageString = '';
      }

      // Sort expert's categories and related categories.
      $expertCategories = array();
      foreach($expert->expertCategories as $category){
          // If this category is already present in the array, do NOT include it a second time
          if(!in_array($category->category, $expertCategories)){
              $expertCategories[] = $category->category;
          }

          foreach($category->associations as $association){
              // If this category is already present in the array, do NOT include it a second time
              if(!in_array($association->category, $expertCategories)){
                  $expertCategories[] = $association->category;
              }
          }
      }
      asort($expertCategories); //sort categories alphabetically

      return view('public.experts.show', compact('expert', 'expertiseString', 'languageString', 'expertCategories'));
  }

  public function expertForm(Expert $expert)
  {
      if (\Auth::check()) {
        // The user is logged in...
        $user = \Auth::user();

        return redirect()->action('Admin\ExpertsController@show', []);
      } else {
        $user = cas()->user();

        $expertSubmissions = $this->expert->where([
            ['submitter_username', $user]
            ])->get();

        return view('public.experts.form', compact('expert', 'expertSubmissions'));
      }
  }

  /**
   * Used to refresh the table of a user's experts entries (public side)
   */
  public function userExperts(Expert $expert)
  {
    $user = cas()->user();

    if($user){
      $expertSubmissions = Expert::where('submitter_username', $user)->orderBy('created_at', 'desc')->get();
    } else {
      return "There was an error. Experts table could not be loaded";
    }

    if(\Request::ajax()) {
      $view = \View::make('public.experts.form', compact('expert', 'expertSubmissions'));
      $view = $view->renderSections();
      return json_encode($view['content-middle']);
    }
  }
 }
