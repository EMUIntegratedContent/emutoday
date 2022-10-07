<?php

namespace Emutoday\Http\Controllers;

use Emutoday\MediaHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaHighlightController extends Controller
{
    private $highlight;
    public function __construct(MediaHighlight $highlight) {
        $this->highlight = $highlight;
    }
}
