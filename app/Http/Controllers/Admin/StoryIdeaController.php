<?php

namespace Emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal;
use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;
use Emutoday\StoryIdea;
use JavaScript;

class StoryIdeaController extends Controller
{
    private $idea;
    private $bugService;

    public function __construct(IBug $bugService, StoryIdea $idea)
    {
        $this->idea = $idea;

        $this->bugService = $bugService;
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
				View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.storyideas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(){
      $idea = $this->idea;

      $user = \Auth::user();

      JavaScript::put([
          'cuser' => $user,
      ]);

      return view('admin.storyideas.form', compact('idea'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $idea = $this->idea->findOrFail($id);
        if(!$idea){
          throw $this->createNotFoundException('The story idea with the id ' . $id . ' was not found.');
        }
        return view('admin.storyideas.form', compact('idea'));
    }

    /**
     * Show the form for editing story idea email settings
     */
    public function settings(){
      return view('admin.storyideas.settings', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
