<?php

namespace App\Services\ImageManager;

use App\Services\ImageManager\Data\ResizeImageData;
use Illuminate\Http\UploadedFile;

interface ImageManager
{
    public function optimize(UploadedFile $image): self;

    public function resize(ResizeImageData $data): self;

    public function store(): string;

}
