<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Facades\Cas;
use Emutoday\Http\Controllers\Controller;
use Emutoday\InsideemuIdea;

class InsideemuIdeaController extends Controller
{
  protected $idea;

  public function __construct(InsideemuIdea $idea)
  {
    $this->idea = $idea;
    $this->middleware('auth', ['only' => ['index', 'create', 'edit']]);
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = Cas::user();
    return view('public.insideemu.ideas.index', compact('user'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $user = Cas::user();
    return view('public.insideemu.ideas.new', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(InsideemuIdea $idea)
  {
    $ideaId  = $idea->id;
    $user = Cas::user();

    return view('public.insideemu.ideas.edit', compact('ideaId', 'user'));
  }
}
