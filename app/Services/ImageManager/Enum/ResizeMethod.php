<?php

namespace App\Services\ImageManager\Enum;

enum ResizeMethod: string
{
    case FIT = 'fit';
    case COVER = 'cover';

}
