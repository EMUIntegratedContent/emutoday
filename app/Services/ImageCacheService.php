<?php

namespace Emutoday\Services;

use FilesystemIterator;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Laravel\Facades\Image;
use phpseclib3\Exception\FileNotFoundException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class ImageCacheService
 *
 * Created by CP to handle image caching. The package intervention/imagecache is no longer supported in Laravel 11.
 * This is a custom solution.
 */
class ImageCacheService {
	protected array $paths = [];
	protected string|null $filePath = null;
	protected array $filterMap = [];

	public function __construct(){
		// Set the paths to search for images. Include new ones as needed.
		$this->paths = [
			public_path('imgs'),
			public_path('imgs/story'),
			public_path('imgs/magazine'),
			public_path('imgs/user'),
			public_path('imgs/event'),
			public_path('imgs/placeholder'),
			public_path('imgs/expert'),
			public_path('imgs/insideemu_posts'),
		];

		// Map the filter names to the functions that apply the filters
		$this->filterMap = [
			'avatar160' => 'avatar160',
			'betterthumb' => 'betterThumb',
			'emailmain' => 'emailMain',
			'emailsub' => 'emailSub',
			'emu175' => 'emu175',
			'expertmedium' => 'expertMedium',
			'expertthumb' => 'expertThumb',
			'featuredevent' => 'featuredEvent',
			'magazinecover' => 'magazineCover',
			'smallthumb' => 'smallThumb'
		];
	}

	public function getFilePath(): string|null {
		return $this->filePath;
	}

	/**
	 * Traverse $this->paths recursively to find path of $filename. Set $this->filePath to the path if found.
	 * @param string $filename
	 * @return string
	 */
	public function setFilePath(string $filename): string {
		foreach($this->paths as $path) {
			if(!is_dir($path)) {
				continue;
			}

			// RecursiveIteratorIterator is a PHP native class. It is performance-optimized for recursive iteration.
			$iterator = new RecursiveIteratorIterator(
				// The RecursiveDirectoryIterator provides an interface for iterating recursively over filesystem directories.
				new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
				RecursiveIteratorIterator::SELF_FIRST
			);

			foreach($iterator as $file) {
				if($file->isFile() && $file->getFilename() === $filename) {
					$this->filePath = $file->getPathname();
					return $this->filePath;
				}
			}
		}
		throw new FileNotFoundException("File not found: $filename");
	}

	/**
	 * Apply the filter to the image
	 * @param string $filter
	 * @return ImageInterface
	 */
	public function applyFilter(string $filter = 'original') {
		// Return the function specified in the filterMap array
		if(array_key_exists($filter, $this->filterMap)) {
			return $this->{$this->filterMap[$filter]}();
		}
		return Image::read($this->filePath); // no filter? return the original image
	}

	/**
	 * Resize the image to 160x160 for avatars
	 * @return \Intervention\Image\Image
	 */
	protected function avatar160(): \Intervention\Image\Image {
		return Image::read($this->filePath)->cover(160, 160);
	}

	/**
	 * Custom thumbnail for various uses (maintain aspect ratio)
	 * @return \Intervention\Image\Image
	 */
	protected function betterThumb(): \Intervention\Image\Image {
		$image = Image::read($this->filePath);
		$height = $image->height() * 0.25;
		return Image::read($this->filePath)->scale(height: $height);
	}

	/**
	 * Resize the image to 600x500 for email main (maintain aspect ratio)
	 * @return \Intervention\Image\Image
	 */
	protected function emailMain(): \Intervention\Image\Image {
		// scale() resizes but maintains aspect ratio (unlike resize())
		return Image::read($this->filePath)->scale(600, 500);
	}

	/**
	 * Resize the email sub images to 258px wide (maintain aspect ratio)
	 * @return \Intervention\Image\Image
	 */
	protected function emailSub(): \Intervention\Image\Image {
		return Image::read($this->filePath)->scale(width: 258);
	}

	/**
	 * Resize the image to 616px for emu175 (maintain aspect ratio)
	 * @return \Intervention\Image\Image
	 */
	protected function emu175(): \Intervention\Image\Image {
		return Image::read($this->filePath)->scale(width: 616);
	}

	/**
	 * Resize the expert medium image to 418px high (maintain aspect ratio)
	 * @return \Intervention\Image\Image
	 */
	protected function expertMedium(): \Intervention\Image\Image {
		return Image::read($this->filePath)->scale(height: 418);
	}

	/**
	 * Resize the expert thumb image to 120x150
	 * @return \Intervention\Image\Image
	 */
	protected function expertThumb(): \Intervention\Image\Image {
		return Image::read($this->filePath)->resize(120, 150);
	}

	/**
	 * Resize the featured event image to 412x248 (maintain aspect ratio)
	 * @return \Intervention\Image\Image
	 */
	protected function featuredEvent(): \Intervention\Image\Image {
		return Image::read($this->filePath)->scale(412, 248);
	}

	/**
	 * Resize the magazine cover image to 240x320 (maintain aspect ratio)
	 * @return \Intervention\Image\Image
	 */
	protected function magazineCover(): \Intervention\Image\Image {
		return Image::read($this->filePath)->scale(240, 320);
	}

	/**
	 * Resize the small thumb image to 120x120 (maintain aspect ratio)
	 * @return \Intervention\Image\Image
	 */
	protected function smallThumb(): \Intervention\Image\Image {
		return Image::read($this->filePath)->scaleDown(100, 100);
	}
}
