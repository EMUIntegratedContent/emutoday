<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\Magazine;
use Emutoday\Mediatype;
use Emutoday\Story;
use Emutoday\StoryImage;
use Emutoday\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Request as Input;
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
		}])->orderBy('story_position', 'asc')->get();
		return $this->setStatusCode(200)->respond(['issue_id' => $issue_id, 'stories' => $stories]);
	}

	/**
	 * Save articles for the magazine issue
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function saveArticles(Request $request) {
		$issue_id = $request->get('issueId');
		$article_ids = $request->get('articles');

		// Sync the articles in the database
		$storyIDsForPivotArray = [];
		for($i = 0; $i < count($article_ids); $i++) {
			$namedKey = $article_ids[$i];
			if($namedKey) {
				$attributeArray['story_position'] = intval($i);
				$storyIDsForPivotArray[intval($namedKey)] = $attributeArray;
			}
		}
		$magazine = $this->magazine->findOrFail($issue_id);
		$magazine->storys()->sync($storyIDsForPivotArray);

		// Magazine is not ready unless positions 0-5 are filled (Saving stories now handled in Api/MagazineController because Magazine Builder is in Vue)
		$missingArticles = 6;
		foreach($magazine->storys as $story) {
			$position = $story->pivot->story_position;
			if($position <= 5) {
				$missingArticles--;
			}
		}
		$magazineMediaCount = Mediatype::ofGroup('magazine')->where('is_required',1)->count();
		if($missingArticles > 0 || $magazine->mediafiles->count() < $magazineMediaCount){
			$magazine->is_ready = 0;
		} else {
			$magazine->is_ready = 1;
		}
		$magazine->save();

		// Return the updated stories to the front end
		$stories = $magazine->storys()->with(['images' => function($query){
			$query->where('group','=','article');
		}])->orderBy('story_position', 'asc')->get();

		return $this->setStatusCode(200)->respondSavedWithData('Articles have been saved.', ['stories' => $stories]);
	}
}
