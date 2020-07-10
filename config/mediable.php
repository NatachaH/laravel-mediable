<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | More information in the config filesystems.php
    |
    */

    'disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Resize for images
    |--------------------------------------------------------------------------
    |
    | Here you may specify the sizes to use when an image is uploaded
    |
    */

    'sizes' => [

        'thumbnails' => 160,

        /*
        'posts' => [
          'fit'    => null,
          'height' => [100,200],
          'width'  => [400,800]
        ]
        */

    ],

    /*
    |--------------------------------------------------------------------------
    | Watermark for images
    |--------------------------------------------------------------------------
    |
    | Here you may specify the watermark to use when an image is uploaded
    | That's not applied on the original image, but only on the resized.
    |
    */

    'watermark' => [

        'enable' => false, // Enable the watermark

        'src' => 'images/watermark.png', // Must be in public folder

        'position' => [
          'name' => 'bottom-right',
          'x' => 5,
          'y' => 5
         ]

    ],

];
