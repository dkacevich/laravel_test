<?php

namespace App\Services\ImageManager\TInyPng;

use App\Services\ImageManager\Data\ResizeImageData;
use App\Services\ImageManager\ImageManager;
use Http;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Throwable;

class TinyPngImageManager implements ImageManager
{
    const API_URI = "https://api.tinify.com";

    private ?string $imageId = null;

    public function __construct(
        private readonly string $apiKey
    ) {}

    public function __destruct()
    {
        try {
            Storage::disk('local')->delete($this->imageId);
        } catch (Throwable) {
        }
    }


    public function optimize(UploadedFile $image): self
    {
        $response = Http::withBody($image->openFile(), $image->getType())
            ->withBasicAuth('Authorization', $this->apiKey)
            ->post(self::API_URI . '/shrink')
            ->json('output');


        $this->imageId = basename(parse_url($response['url'], PHP_URL_PATH));

        return $this;
    }

    public function resize(ResizeImageData $data): self
    {
        $body = [
            'resize' => [
                'method' => $data->resize_method->value,
                'width' => $data->width,
                'height' => $data->height
            ]
        ];

        $response = Http::withBasicAuth('Authorization', $this->apiKey)
            ->post(self::API_URI . "/output/$this->imageId", $body);


        Storage::disk('tmp')->put($this->getFilename(), $response);

        return $this;
    }


    public function store(): string
    {
        $file = Storage::disk('tmp')->get($this->getFilename());
        Storage::disk('media')->put($this->getFilename(), $file);
        Storage::disk('tmp')->delete($this->getFilename());

        return $this->getFilename();

    }


    private function getFilename(): string
    {
        return $this->imageId . '.jpg';
    }


}
