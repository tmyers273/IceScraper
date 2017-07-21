<?php

namespace tmyers273\IceScraper\Strategies;

use tmyers273\IceScraper\ScraperResponse;

class XPathMultipleStrategy {

    protected $name;
    protected $html;
    protected $xpath;
    protected $source;
    protected $default;

    public function __construct(ScraperResponse $source, $name, $xpath, $html = false, $default = null)
    {
        $this->name = $name;
        $this->html = $html;
        $this->xpath = $xpath;
        $this->source = $source;
        $this->default = $default;
    }

    public function handle()
    {
        return $this->source->xpathMultiple($this->xpath, $this->default, $this->html);
    }

    public function getName()
    {
        return $this->name;
    }

}