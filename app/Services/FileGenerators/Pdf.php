<?php

namespace App\Services\FileGenerators;

use App\Contracts\PrintableInterface;
use View;

class Pdf extends \Knp\Snappy\Pdf
{
    /**
     * Initialize a new pdf instance.
     *
     * @param array $config
     *
     * @return void
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config['binary'], $config['generator']);
    }

    public function render(PrintableInterface $printable, $options = []): string
    {
        $this->initializeOptions($options);

        return $this->getOutputFromHtml(
            View::make($printable->getTemplateName(), ['data' => $printable->getData()])->render()
        );
    }

    protected function initializeOptions(array $options = []) : void
    {
        foreach ($options as $optionKey => $optionValue) {
            $this->setOption((string)$optionKey, $optionValue);
        }
    }

}
