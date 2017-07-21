<?php

namespace tmyers273\IceScraper\Pipeline;

use tmyers273\IceScraper\ScraperItem;

class ItemPipeline {

    protected $pipes;

    public function __construct($pipes = [])
    {
        $pipes = $this->validatePipes($pipes);
        $this->pipes = $pipes;
    }

    public function push(ScraperItem $item)
    {
        foreach($this->pipes as $pipe) {
            $item = $pipe->run($item);
        }

        return $item;
    }

    protected function validatePipes($pipes)
    {
        if (! is_array($pipes)) {
            $pipes = [$pipes];
        }

        foreach($pipes as $pipe) {
            if (! $pipe instanceof Pipe) {
                throw new \Exception("Invalid type. Only Pipe objects should be in the pipeline");
            }
        }

        return $pipes;
    }

}