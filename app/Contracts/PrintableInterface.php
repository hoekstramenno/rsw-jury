<?php

namespace App\Contracts;

interface PrintableInterface
{
    public function getTemplateName(): string;

    public function getData(): array;

    public function addData(string $key, $value) : void;
}
