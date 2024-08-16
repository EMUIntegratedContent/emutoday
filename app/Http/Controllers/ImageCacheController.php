<?php

namespace Emutoday\Http\Controllers;

use Emutoday\Services\ImageCacheService;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\AutoEncoder;
use phpseclib3\Exception\FileNotFoundException;

class ImageCacheController extends Controller{

	protected Image $image;
	protected ImageCacheService $service;

	public function __construct(Image $image, ImageCacheService $imageCacheService){
		$this->image = $image;
		$this->service = $imageCacheService;
	}

	public function imagecache(string $template, string $filename){
		$cacheKey = md5($template . $filename);

		// Check if image exists in cache
		$cachedImage = Cache::get($cacheKey);
		if ($cachedImage) {
			return response($cachedImage)->header('Content-Type', 'image/jpeg');
		}

		try {
			// Set the filepath in the service
			$filePath = $this->service->setFilePath($filename);
		} catch (FileNotFoundException $e) {
			abort(404, $e->getMessage());
		}

		// Apply the filter to the image
		$image = $this->service->applyFilter($template);

		// Cache the processed image
		$imageData = (string) $image->encode(new AutoEncoder());
		Cache::put($cacheKey, $imageData, now()->addDays(7)); // Cache for 7 days

		// Return the processed image
		return response($imageData)->header('Content-Type', 'image/jpeg');
	}
}
