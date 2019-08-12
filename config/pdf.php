<?php

return [

    'binary' => env('WKHTML_PATH', realpath(h4cc\WKHTMLToPDF\WKHTMLToPDF::PATH)),

    'generator' => [
        'images' => true,
        'no-images' => false,
        'encoding' => 'utf-8',
        'disable-smart-shrinking' => true,
        'page-size' => 'A4',
//        'margin-top' => 0,
//        'margin-left' => 0,
//        'margin-right' => 0,
//        'margin-bottom' => 0,
    ],

];
