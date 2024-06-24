<?php

$sizes = [3200, 2500, 1920, 1680, 1440, 1280, 1024, 768, 640, 480, 320];
$image_sizes = [
    'sizes' => [],
];

foreach ($sizes as $size) {
    $new_size = [
        'name' => "size_{$size}",
        'width' => $size,
        'height' => 0,
    ];

    array_push($image_sizes['sizes'], $new_size);
}

return $image_sizes;
