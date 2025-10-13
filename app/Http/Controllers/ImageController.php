<?php

namespace App\Http\Controllers;

use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class ImageController extends Controller
{
    public function __invoke($path)
    {
        $disk = app('filesystem')->disk('main')->getDriver();

        $server = ServerFactory::create([
            'response'          => new LaravelResponseFactory(app('request')),
            'source'            => $disk,
            'cache'             => $disk,
            'cache_path_prefix' => '.cache',
            'base_url'          => 'glide',
        ]);

        return $server->getImageResponse($path, request()->all());
    }
}
