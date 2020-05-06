<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\Magazine;
use Emutoday\Story;
use Emutoday\StoryImage;
use Emutoday\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;
use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalStoryTransformerModel;
class MagazineController extends ApiController
{
  function __construct(Magazine $magazine)
  { //
  	$this->magazine = $magazine;
  }

  /**
   * Get all Magazine articles and their images
	 * @param Request $request
	 * @param string $fromDate
	 * @param string $toDate
   * @return JsonResponse
   */
  public function getArticles(Request $request, $fromDate = null, $toDate = null){
		if($fromDate && !$toDate){
			$stories = Story::where([
				['start_date', '>=', $fromDate],
				['story_type', 'article'],
				['is_approved',1]
			])->with(['images' => function($query){
				$query->where('group','=','article');
			}])->orderBy('id', 'desc')->get();
		} elseif($fromDate && $toDate){
			$stories = Story::where([
				['story_type', 'article'],
				['is_approved',1]
			])->whereBetween('start_date', array($fromDate, $toDate))
				->with(['images' => function($query){
				$query->where('group','=','article');
			}])->orderBy('id', 'desc')->get();
		} else{
			$stories = Story::where([
				['start_date', '>=', $fromDate],
				['story_type', 'article'],
				['is_approved', 1]
			])->with(['images' => function ($query){
				$query->where('group', '=', 'article');
			}])->orderBy('id', 'desc')->get();
		}
		return $this->setStatusCode(200)->respond(['stories' => $stories]);
  }

	/**
	 * Get all Magazine articles and their images (for the current issue)
	 * @param Request $request
	 * @param $issue_id
	 * @return JsonResponse
	 */
  public function getArticlesForIssue(Request $request, $issue_id) {
		$magazine = $this->magazine->findOrFail($issue_id);
		$stories = $magazine->storys()->with(['images' => function($query){
			$query->where('group','=','article');
		}])->orderBy('id', 'desc')->get();
		return $this->setStatusCode(200)->respond(['issue_id' => $issue_id, 'stories' => $stories]);
	}
}
