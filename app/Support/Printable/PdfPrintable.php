<?php

namespace App\Support\Printable;

use App\Contracts\PrintableInterface;
use Illuminate\Contracts\Support\Arrayable;

class PdfPrintable implements PrintableInterface
{
    /**
     * @var string
     */
    protected $templateName;

    /**
     * @var \Illuminate\Contracts\Support\Arrayable
     */
    protected $dataModel;

    protected $extraData = [];

    public function __construct(string $templateName, Arrayable $dataModel)
    {
        $this->templateName = $templateName;
        $this->dataModel    = $dataModel;
    }

    public function getTemplateName(): string
    {
        return $this->templateName;
    }

    public function getData(): array
    {

        $data = $this->dataModel->toArray();
        return $data + $this->extraData;
    }

    public function addData(string $key, $value): void
    {
        $this->extraData[$key] = $value;
    }
}
