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
    | Customize the buttons
    |--------------------------------------------------------------------------
    |
    | Here you may specify the class and the value of each button in the component view
    |
    */

    'buttons' => [
        'delete' => [
          'class' => 'btn-gray rounded-circle',
          'value' => '<i class="icon icon-trash"></i>'
        ],
        'download' => [
          'class' => 'btn-gray',
          'value' => '<i class="icon-download"></i>'
        ],
        'download-input-group' => [
          'class' => 'btn-gray rounded-circle',
          'value' => '<i class="icon-download"></i>'
        ],
        'drag' => [
          'class' => 'pl-0',
          'value' => '<i class="icon-move"></i>'
        ]
    ]

];
