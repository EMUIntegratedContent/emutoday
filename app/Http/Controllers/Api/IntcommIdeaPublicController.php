<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\Http\Resources\IntcommIdeaResource;
use Emutoday\IntcommIdea;
use Emutoday\IntcommIdeasImages;
use Emutoday\IntcommPost;
use Emutoday\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class IntcommIdeaPublicController extends ApiController{
	protected $idea;
	protected $validationRules = [
		'title' => 'required|max:255',
		'content' => 'required',
		'contributor_netid' => 'required',
		'contributor_first' => 'required',
		'contributor_last' => 'required',
		'other_source' => 'required_if:use_other_source,1'
	];
	protected $draftValidationRules = [
		'title' => 'required|max:255',
		'contributor_netid' => 'required',
		'contributor_first' => 'required',
		'contributor_last' => 'required',
	];

	function __construct(IntcommIdea $idea){
		$this->idea = $idea;
	}

	/**
	 * Get the ideas for a specific netid.
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request){
		$netid = $request->get('netid');
		if(!$netid){
			return response()->json(['error' => 'Netid is required.'], 400);
		}

		$ideas = $this->idea->where('contributor_netid', $netid)->orderBy('created_at', 'desc')->get();

		return response()->json(IntcommIdeaResource::collection($ideas));
	}

	/**
	 * Display the specified resource.
	 */
	public function show($ideaId){
		$idea = $this->idea->with('images')->findOrFail($ideaId);
		return response()->json(IntcommIdeaResource::make($idea));
	}

	/**
	 * Get the specified post
	 */
	public function edit(IntcommIdea $idea){
//    $fractal = new Manager();
//    $resource = new Fractal\Resource\Item($email, new FractalEmailTransformerModel);
//
//    return $this->setStatusCode(200)
//        ->respondUpdatedWithData('Got email.', $fractal->createData($resource)->toArray());
	}

	/**
	 * Store a new idea
	 */
	public function store(Request $request){
		$idea = json_decode($request->get('idea'), true);
		$saveType = $request->get('saveType');
		if (!$idea || !$saveType) {
			return response()->json(['error' => 'Invalid parameters.'], 400);
		}

		$ideaId = isset($idea['ideaId']) ?: null;
		if($ideaId){
			$idea = $this->idea->findOrFail($ideaId);
			if($idea) {
				return response()->json(['error' => 'Idea already exists.'], 400);
			}
		}

		$data = [
			'title' => $idea['title'],
			'teaser' => $idea['teaser'],
			'content' => $idea['content'],
			'contributor_netid' => $idea['contributor_netid'],
			'contributor_first' => $idea['contributor_first'],
			'contributor_last' => $idea['contributor_last'],
			'use_other_source' => $idea['use_other_source'],
			'other_source' => $idea['other_source']
		];

		if($saveType == 'draft'){
			$validator = Validator::make($data, $this->draftValidationRules);
		} else {
			$validator = Validator::make($data, $this->validationRules);
		}

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 400);
		}

		$newIdea = new IntcommIdea();
		$newIdea->fill($data);
		$newIdea->save();

		// Handle any attached images files from the request
		$destinationFolder = '/imgs/intcomm/ideas/'.$newIdea->id.'/';
		if (!empty(Input::file('images'))){
			foreach(Input::file('images') as $image){
				// If the path doesn't exist, create it
				if (!file_exists(public_path() . $destinationFolder)) {
					mkdir(public_path() . $destinationFolder, 0777, true);
				}

				$imgFilePath = $image->getRealPath();
				$imgFileName = $image->getClientOriginalName();

				Image::make($imgFilePath)
					->save(public_path() . $destinationFolder . $imgFileName);
			}
		}

		// TODO keep refining this whole method and the image handling
		foreach($idea['images'] as $image){
			$ideaImage = new IntcommIdeasImages();
			$ideaImage->intcomm_idea_id = $newIdea->id;
			$ideaImage->image_name = $image['image_name'];
			$ideaImage->image_path = '/imgs/intcomm/ideas/'.$newIdea->id.'/'.$image['image_name'];
			$ideaImage->description = $image['description'];
			$ideaImage->save();
		}

		return response()->json(IntcommIdeaResource::make($newIdea));
	}

	/**
	 * Update the specified post
	 * @param Request $request
	 * @param int $ideaId
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, int $ideaId){
		$ideaArr = json_decode($request->get('idea'), true);
		$saveType = $request->get('saveType');
		if (!$ideaArr || !$saveType) {
			return response()->json(['error' => $request->all()], 400);
		}

		$idea = $this->idea->findOrFail($ideaId);
		if(!$idea){
			return response()->json(['error' => 'Idea not found.'], 404);
		}

		$data = [
			'title' => $ideaArr['title'],
			'teaser' => $ideaArr['teaser'],
			'content' => $ideaArr['content'],
			'contributor_netid' => $idea->contributor_netid, // use existing netid
			'contributor_first' => $ideaArr['contributor_first'],
			'contributor_last' => $ideaArr['contributor_last'],
			'use_other_source' => $ideaArr['use_other_source'],
			'other_source' => $ideaArr['other_source']
		];

		if($saveType == 'draft'){
			$validator = Validator::make($data, $this->draftValidationRules);
		} else {
			$validator = Validator::make($data, $this->validationRules);
		}

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 400);
		}

		$idea->fill($data);
		$idea->is_submitted = $saveType == 'draft' ? 0 : 1;
		$idea->save();

		// Remove any images that are no longer associated with the idea
		$images = $idea->images;
		foreach($images as $image){
			$found = false;
			foreach($ideaArr['images'] as $newImage){
				if($image->id == $newImage['id']){
					$found = true;
					break;
				}
			}
			if(!$found){
				$image->delete();
				// Also remove the file from the server
				$filePath = public_path() . $image->image_path;
				if(file_exists($filePath)){
					unlink($filePath);
				}
			}
		}

		// Handle any attached images files from the request (these will be new images)
		$destinationFolder = '/imgs/intcomm/ideas/'.$idea->id.'/';
		if (!empty(Input::file('images'))){
			foreach(Input::file('images') as $image){
				// If the path doesn't exist, create it
				if (!file_exists(public_path() . $destinationFolder)) {
					mkdir(public_path() . $destinationFolder, 0777, true);
				}

				$imgFilePath = $image->getRealPath();
				$imgFileName = $image->getClientOriginalName();

				Image::make($imgFilePath)
					->save(public_path() . $destinationFolder . $imgFileName);
			}
		}

		// Update the database with new and existing image information
		foreach($ideaArr['images'] as $image){
			// If the id contains 'new', it's a new image
			if(strpos($image['id'], 'new') !== false){
				$ideaImage = new IntcommIdeasImages();
				$ideaImage->intcomm_idea_id = $idea->id;
				$ideaImage->image_name = $image['image_name'];
				$ideaImage->image_path = '/imgs/intcomm/ideas/'.$idea->id.'/'.$image['image_name'];
			} else {
				$ideaImage = IntcommIdeasImages::findOrFail($image['id']);
			}
			$ideaImage->description = $image['description'];
			$ideaImage->save();
		}

		$idea = $this->idea->findOrFail($ideaId); // get the entire updated idea
		return response()->json(IntcommIdeaResource::make($idea));
	}

	/**
	 * Delete a post.
	 * @param int $id
	 * @return array
	 */
	public function destroy($id){
//    $email = $this->email->findOrFail($id);
//    $email->delete();
//    return $this->setStatusCode(200)->respond('Email successfully deleted!');
	}
}
