<?php

namespace WebduoNederland\LaravelImageResizer\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    protected string $path;
    protected array $dimensions = [
        'width' => null,
        'height' => null,
    ];
    protected $storage;
    protected $defaultPath;

    public function __construct(Request $request)
    {
        $this->path = $request->image_path;

        if ($request->has('w')) $this->dimensions['width'] = $request->w;
        if ($request->has('h')) $this->dimensions['height'] = $request->h;

        $this->storage = Storage::disk(config('laravel-image-resizer.disk'));
        $this->defaultPath = config('laravel-image-resizer.default_path');

        Image::configure(['driver' => 'imagick']);
    }

    public function index(): Image|Response
    {
        /** @var bool|string|Image $image */
        $image = $this->getImage();

        if (!$image) {
            return response(config('laravel-image-resizer.not_found'), 404);
        }

        if (gettype($image) === 'string') { // SVG
            return $image;
        } else {
            return $image->response()
                ->header('Cache-Control', 'max-age='.config('laravel-image-resizer.browser_cache_duration', 2592000));
        }
    }

    public function getImage(): bool|string|Image
    {
        if ($this->storage->exists($this->defaultPath.'/'.$this->path)) {
            $path = $this->defaultPath.'/'.$this->path;
            $file = $this->storage->get($path);
            $dimensions = collect($this->dimensions);
            $image = null;

            // If the image is an SVG return without modifying
            if ($this->storage->mimeType($path) === 'image/svg+xml') {
                return $file;
            }
            
            // Resize image if there are dimensions in the URL
            if ($dimensions->whereNotNull()->count() > 0) {
                $image = Image::cache(function($image) use ($file, $dimensions) {
                    $image->make($file)
                        ->resize($dimensions['width'], $dimensions['height'], function ($constraint) {
                            $constraint->aspectRatio();
                        });
                }, config('laravel-image-resizer.cache_duration', 10), true);
            } else {
                $image = Image::make($file);
            }

            return $image;
        } else {
            return false;
        }
    }
}