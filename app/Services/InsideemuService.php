<?php

namespace Emutoday\Services;

use Emutoday\InsideemuIdea;
use Emutoday\InsideemuPost;
use Emutoday\InsideemuIdeasImages;
use Emutoday\InsideemuPostsImages;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

/**
 * Class InsideemuService
 * @package Emutoday\Services
 * This class is used to handle the business logic for the InsideemuIdea model.
 * This prevents the controllers from becoming bloated with logic.
 */
class InsideemuService
{
	/**
	 * Handle the images for an idea.
	 * @param InsideemuIdea $idea
	 * @param $ideaArr array The idea array from the request
	 */
	public function handleIdeaImages(InsideemuIdea $idea, array $ideaArr)
	{
		$images = $idea->images; // the insideemu_ideas_images records already associated with the idea
		foreach ($images as $image) {
			$found = false;
			// The images that were passed in the request
			foreach ($ideaArr['images'] as $newImage) {
				if ($image->id == $newImage['id']) { // If there is a match, the image is still associated with the idea
					$found = true;
					break;
				}
			}
			// Remove the insideemu_ideas_images record and the image file if it is no longer associated with the idea
			if (!$found) {
				$image->delete();
				// Also remove the file from the server
				$filePath = public_path() . $image->image_path;
				if (file_exists($filePath)) {
					unlink($filePath);
				}
			}
		}

		// Handle any new images files from the request.
		$newImgFileNames = []; // store new, timestamped and sanitized image names
		$destinationFolder = '/imgs/uploads/insideemu/ideas/' . $idea->id . '/';
		if (!empty(Input::file('images'))) {
			foreach (Input::file('images') as $image) {
				// If the path doesn't exist, create it
				if (!file_exists(public_path() . $destinationFolder)) {
					mkdir(public_path() . $destinationFolder, 0777, true);
				}

				$imgFilePath = $image->getRealPath();
				$imgFileName = $this->sanitizeImageName($image->getClientOriginalName());
				$imgFileName = $this->appendNewTimestamp($imgFileName);

				$newImgFileNames[$image->getClientOriginalName()] = $imgFileName;

				// Resize image to max width/height to prevent memory exhaustion (only resize if the image is larger than the max width/height)
				$maxWidth = 1280;
				$maxHeight = 1280;

				Image::read($imgFilePath)
					->scaleDown(width: $maxWidth, height: $maxHeight)
					->save(public_path() . $destinationFolder . $imgFileName);

				// Image::read($imgFilePath)
				// 	->save(public_path() . $destinationFolder . $imgName);
			}
		}

		// Update the database with new and existing image information
		foreach ($ideaArr['images'] as $image) {
			// If the id contains 'new', it's a new image
			if (strpos($image['id'], 'new') !== false) {
				$ideaImage = new InsideemuIdeasImages();
				$ideaImage->insideemu_idea_id = $idea->id;

				// Find the new image name in the array of new, sanitized image names (avoids different timestamp issues)
				foreach ($newImgFileNames as $originalName => $newName) {
					if ($image['image_name'] == $originalName) {
						$ideaImage->image_name = $newName;
						$ideaImage->image_path = $destinationFolder . $newName;
						break;
					}
				}
			} else {
				$ideaImage = InsideemuIdeasImages::findOrFail($image['id']);
			}
			$ideaImage->description = $image['description'];
			$ideaImage->save();
		}
	}

	public function handlePostImages(InsideemuPost $post, array $postArr)
	{
		$destinationFolder = '/imgs/insideemu_posts/' . $post->id . '/';

		$images = $post->images;

		$changedFileNames = []; // store existing images whose updates resulted in new, timestamped and sanitized image names
		foreach ($images as $image) {
			$found = false;
			// Check if each $postArr['images'] id matches an image id
			// $postArr['images'] is the array of images from the request (corresponding to insideemu_post_images records)
			foreach ($postArr['images'] as $newImage) {
				if ($image->id == $newImage['id']) {
					// If the image's name or path has changed, update it in the filesystem
					$oldFilePath = public_path() . $image->image_path;
					$newFilePath = public_path() . $destinationFolder . $newImage['image_name'];
					if (file_exists($oldFilePath) && $oldFilePath != $newFilePath) {
						$sanitizedNewFile = $this->sanitizeImageName($newImage['image_name']);
						$newFilename = $this->appendNewTimestamp($sanitizedNewFile);
						$sanitizedNewPath = public_path() . $destinationFolder . $newFilename;
						rename($oldFilePath, $sanitizedNewPath);

						$changedFileNames[$newImage['image_name']] = $newFilename;
					}
					$found = true; // Flag that the image was found
					break;
				}
			}
			// Remove any images that are no longer associated with the post
			if (!$found) {
				$image->delete();
				// Also remove the file from the server
				$filePath = public_path() . $image->image_path;
				if (file_exists($filePath)) {
					unlink($filePath);
				}
			}
		}

		// Handle any attached images files from the request (these will be new images)
		$newImgFileNames = []; // store new, timestamped and sanitized image names
		if (!empty(Input::file('images'))) {
			$count = 0;
			$imgNames = Input::get('imageNames');
			foreach (Input::file('images') as $image) {
				// If the path doesn't exist, create it
				if (!file_exists(public_path() . $destinationFolder)) {
					mkdir(public_path() . $destinationFolder, 0777, true);
				}

				$imgFilePath = $image->getRealPath();
				$imgName = $this->sanitizeImageName($imgNames[$count]);
				$imgName = $this->appendNewTimestamp($imgName);

				// Resize image to max width/height to prevent memory exhaustion (only resize if the image is larger than the max width/height)
				$maxWidth = 1280;
				$maxHeight = 1280;

				Image::read($imgFilePath)
					->scaleDown(width: $maxWidth, height: $maxHeight)
					->save(public_path() . $destinationFolder . $imgName);

				// Image::read($imgFilePath)
				// 	->save(public_path() . $destinationFolder . $imgName);

				$newImgFileNames[$image->getClientOriginalName()] = $imgName;

				$count++;
			}
		}

		// Update the database with new and existing image information
		foreach ($postArr['images'] as $image) {
			// If there is no id or if it's 0, it's a new image
			if (!$image['id'] || $image['id'] == 0) {
				$postImage = new InsideemuPostsImages();
				$postImage->insideemu_post_id = $post->id;
				$postImage->imagetype_id = $image['imagetype_id'];

				// Find the new image name in the array of new, sanitized image names (avoids different timestamp issues)
				foreach ($newImgFileNames as $originalName => $newName) {
					if ($image['image_name'] == $originalName) {
						$postImage->image_name = $newName;
						$postImage->image_path = $destinationFolder . $newName;
						break;
					}
				}
			} else {
				$postImage = InsideemuPostsImages::findOrFail($image['id']);

				// If the image's name has changed, update it in the filesystem
				$oldName = $postImage->image_name;
				$newPath = $image['image_name'];
				if ($oldName != $newPath) {
					// Find the new image name in the array of new, sanitized image names (avoids different timestamp issues)
					foreach ($changedFileNames as $originalName => $newName) {
						if ($image['image_name'] == $originalName) {
							$postImage->image_name = $newName;
							$postImage->image_path = $destinationFolder . $newName;
							break;
						}
					}
				}
			}
			$postImage->title = $image['title'];
			$postImage->caption = $image['caption'];
			$postImage->teaser = $image['teaser'];
			$postImage->moretext = $image['moretext'];
			$postImage->link = $image['link'];
			$postImage->link_text = $image['link_text'];
			$postImage->alt_text = $image['alt_text'];
			$postImage->image_extension = $image['image_extension'];
			$postImage->save();
		}
	}

	/**
	 * Delete the image directory an all associated images for a post.
	 * @param string $postId
	 */
	public function deletePostImages(string $postId)
	{
		$destinationFolder = '/imgs/insideemu_posts/' . $postId . '/';
		if (file_exists(public_path() . $destinationFolder)) {
			$files = glob(public_path() . $destinationFolder . '*');
			foreach ($files as $file) {
				if (is_file($file)) {
					unlink($file);
				}
			}
			rmdir(public_path() . $destinationFolder);
		}
	}

	/**
	 * Delete the image directory an all associated images for an idea.
	 * @param string $ideaId
	 */
	public function deleteIdeaImages(string $ideaId)
	{
		$destinationFolder = '/imgs/uploads/insideemu/ideas/' . $ideaId . '/';
		if (file_exists(public_path() . $destinationFolder)) {
			$files = glob(public_path() . $destinationFolder . '*');
			foreach ($files as $file) {
				if (is_file($file)) {
					unlink($file);
				}
			}
			rmdir(public_path() . $destinationFolder);
		}
	}

	/**
	 * When converting a user-submitted idea to a post, replace any newlines with paragraph tags.
	 * @param $text
	 * @return string
	 */
	public function replaceNewlinesWithPTags($text)
	{
		// Split the text by newlines
		$lines = explode("\n", $text);

		// Wrap each line with <p> tags
		$wrappedLines = array_map(function ($line) {
			$tline = trim($line);
			if (empty($tline)) return ''; // Skip empty lines
			return '<p>' . $tline . '</p>';
		}, $lines);

		// Join the wrapped lines back into a single string
		return implode("\n", $wrappedLines);
	}

	/**
	 * Sanitize the provided filename by removing its timestamp and slugging the base name.
	 *
	 * @param string $imgName
	 * @return string
	 */
	protected function sanitizeImageName($imgName)
	{
		// Extract the base name and remove the timestamp portion
		$filenameWithoutExtension = pathinfo($imgName, PATHINFO_FILENAME);

		$extension = pathinfo($imgName, PATHINFO_EXTENSION);

		// Detect and remove the timestamp
		$basenameParts = explode('_', $filenameWithoutExtension);
		if (is_numeric(end($basenameParts))) {
			array_pop($basenameParts); // Remove the timestamp
		}

		$sanitizedBaseName = implode('_', $basenameParts);

		// Return the sanitized base name
		return Str::slug($sanitizedBaseName, '_') . ($extension ? '.' . $extension : '');
	}

	/**
	 * Appends a new current timestamp to the filename.
	 *
	 * @param string $imgName
	 * @return string
	 */
	protected function appendNewTimestamp($imgName)
	{
		$baseNameWithoutExtension = pathinfo($imgName, PATHINFO_FILENAME);
		$extension = pathinfo($imgName, PATHINFO_EXTENSION);
		$newTimestamp = time();
		return $baseNameWithoutExtension . '_' . $newTimestamp . '.' . $extension;
	}
}
