<?php

return [
    // Prefix for images domain.test/images/...
    'prefix' => 'images',

    // Storage disk where your images are stored
    'disk' => 'local',

    // Default path your images are in e.g. public
    'default_path' => 'public',

    // How long resized images should be cached on the server in minutes
    'cache_duration' => 10,

    // How long images should be cached in the browser (Cache-Control) in seconds (Default 2592000 = 30 days)
    'browser_cache_duration' => 2592000,

    // Image not found text in response
    'not_found' => 'Image not found',
];