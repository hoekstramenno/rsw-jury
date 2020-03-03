<?php

namespace App\Support\Factories\Printable;

use App\Contracts\PrintableFactoryInterface;
use App\Contracts\PrintableInterface;
use App\Support\Printable\PdfPrintable;
use Illuminate\Contracts\Support\Arrayable;

class PdfPrintableFactory implements PrintableFactoryInterface
{
    public function make(string $templateName, Arrayable $dataModel): PrintableInterface
    {
        return new PdfPrintable($templateName, $dataModel);
    }
}
