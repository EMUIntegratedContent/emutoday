<?php

namespace Emutoday\Services;

use Emutoday\IntcommIdea;
use Emutoday\IntcommPost;
use Emutoday\IntcommIdeasImages;
use Emutoday\IntcommPostsImages;
use Illuminate\Support\Facades\Log;
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
		$destinationFolder = '/imgs/uploads/intcomm/ideas/'.$idea->id.'/';
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
				$ideaImage->image_path = $destinationFolder.$image['image_name'];
			} else {
				$ideaImage = IntcommIdeasImages::findOrFail($image['id']);
			}
			$ideaImage->description = $image['description'];
			$ideaImage->save();
		}
	}

	public function handlePostImages(IntcommPost $post, array $postArr)
	{
		$destinationFolder = '/imgs/intcomm_posts/'.$post->id.'/';

		$images = $post->images;
		foreach($images as $image){
			$found = false;
			// Check if each $postArr['images'] id matches an image id
			// $postArr['images'] is the array of images from the request (corresponding to intcomm_post_images records)
			foreach($postArr['images'] as $newImage){
				if($image->id == $newImage['id']){
					// If the image's name or path has changed, update it in the filesystem
					$oldFilePath = public_path() . $image->image_path;
					$newFilePath = public_path() . $destinationFolder . $newImage['image_name'];
					if(file_exists($oldFilePath) && $oldFilePath != $newFilePath){
						rename($oldFilePath, $newFilePath);
					}
					$found = true; // Flag that the image was found
					break;
				}
			}
			// Remove any images that are no longer associated with the post
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
		if (!empty(Input::file('images'))){
			$count = 0;
			$imgNames = Input::get('imageNames');
			foreach(Input::file('images') as $image){
				// If the path doesn't exist, create it
				if (!file_exists(public_path() . $destinationFolder)) {
					mkdir(public_path() . $destinationFolder, 0777, true);
				}

				$imgFilePath = $image->getRealPath();
				$imgFileName = $this->appendExtensionToFilename($imgNames[$count], $image->getClientOriginalExtension());

				Image::make($imgFilePath)
					->save(public_path() . $destinationFolder . $imgFileName);

				$count++;
			}
		}

		// Update the database with new and existing image information
		foreach($postArr['images'] as $image){
			// If there is no id or if it's 0, it's a new image
			if(!$image['id'] || $image['id'] == 0){
				$postImage = new IntcommPostsImages();
				$postImage->intcomm_post_id = $post->id;
				$postImage->imagetype_id = $image['imagetype_id'];
			} else{
				$postImage = IntcommPostsImages::findOrFail($image['id']);
			}
			$postImage->title = $image['title'];
			$postImage->caption = $image['caption'];
			$postImage->teaser = $image['teaser'];
			$postImage->moretext = $image['moretext'];
			$postImage->link = $image['link'];
			$postImage->link_text = $image['link_text'];
			$postImage->alt_text = $image['alt_text'];
			$postImage->image_name = $image['image_name'];
			$postImage->image_path = $destinationFolder.$this->appendExtensionToFilename($image['image_name'], $image['image_extension']);
			$postImage->image_extension = $image['image_extension'];
			$postImage->save();
		}
	}

	/**
	 * Make sure the filename has an extension
	 * @param $filename
	 * @param $extension
	 * @return mixed|string
	 */
	protected function appendExtensionToFilename($filename, $extension)
	{
		$dots = explode('.', $filename);
		if(count($dots) == 1){
			$filename .= '.'.$extension;
		}
		return $filename;
	}
}
