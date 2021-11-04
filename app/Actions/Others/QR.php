<?php

namespace App\Actions\Others;

use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

trait QR{

    private function base(string $data): string
    {
        return (new Writer(
            new ImageRenderer(
                new RendererStyle(192, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(25, 25, 25))),
                new SvgImageBackEnd
            )
        ))->writeString($data);
    }

    public function svg(string $data): string
    {
        $svg = $this->base($data);
        return trim(substr($svg, strpos($svg, "\n") + 1));
    }

    public function png(string $data): void
    {
        header('Content-Type: image/png');
        echo $this->base($data);
    }

    private function configureData(string $object, string $data): string
    {
        return $object.str_pad(strlen($data), 2, "0", STR_PAD_LEFT).$data;
    }
}