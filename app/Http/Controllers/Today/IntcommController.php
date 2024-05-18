<?php

namespace Emutoday\Http\Controllers\Today;
use Emutoday\Http\Controllers\Controller;
use Emutoday\IntcommPost;
use Illuminate\Support\Facades\View;

class IntcommController extends Controller
{

		public function __construct()
		{

		}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
			// TODO show all the relevant posts (public)
			return view('public.intcomm.index');
    }
}
