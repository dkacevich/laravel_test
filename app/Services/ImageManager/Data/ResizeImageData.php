<?php

namespace App\Services\ImageManager\Data;

use App\Services\ImageManager\Enum\ResizeMethod;

class ResizeImageData
{
    public function __construct(
        public readonly ResizeMethod $resize_method,
        public readonly int          $width,
        public readonly int          $height,
    ) {}
}
