<?php

namespace Emutoday\Services;

use Emutoday\IntcommIdea;
use Emutoday\IntcommIdeasImages;
use Illuminate\Support\Facades\Request as Input;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class IntcommService
 * @package Emutoday\Services
 * This class is used to handle the business logic for the IntcommIdea model.
 * This prevents the controllers from becoming bloated with logic.
 */
class IntcommService
{
	/**
	 * Handle the images for an idea.
	 * @param IntcommIdea $idea
	 * @param $ideaArr array The idea array from the request
	 */
	public function handleIdeaImages(IntcommIdea $idea, array $ideaArr)
	{
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
	}
}
