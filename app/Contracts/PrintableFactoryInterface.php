<?php

namespace App\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface PrintableFactoryInterface
{
    public function make(string $view, Arrayable $dataModel): PrintableInterface;
}
