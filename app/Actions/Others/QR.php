<?php

namespace App\Actions\Others;

use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

trait QR{

    private function base(string $data)
    {
        return (new Writer(
            new ImageRenderer(
                new RendererStyle(192, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(25, 25, 25))),
                new SvgImageBackEnd
            )
        ))->writeString($data);
    }

    public function svg(string $data)
    {
        $svg = $this->base($data);
        return trim(substr($svg, strpos($svg, "\n") + 1));
    }

    public function png(string $data)
    {
        header('Content-Type: image/png');
        echo $this->base($data);
    }
}