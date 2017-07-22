<?php

namespace tmyers273\IceScraper;

use Symfony\Component\DomCrawler\Crawler;
use tmyers273\IceScraper\Contracts\ScraperResponse as ScraperResponseContract;

class ScraperResponse implements ScraperResponseContract
{

    protected $source;
    protected $crawler;

    public function __construct($source)
    {
        $this->source = $source;
        $this->crawler = new Crawler($source);
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getCrawler()
    {
        return $this->crawler;
    }

    public function xpath($xpath, $default = null, $html = false)
    {
        $result = $this->crawler->filterXPath($xpath);

        if ($result->count() == 0) {
            return $default;
        }

        if ($html) {
            $result = $result->html();
        } else {
            $result = $result->text();
        }

        return trim($result);
    }

    public function xpathMultiple($xpath, $default = null, $html = false)
    {
        $result = $this->crawler->filterXPath($xpath);

        if ($result->count() == 0) {
            return $default;
        }

        $output = [];

        foreach($result as $item) {
            $item = new Crawler($item);

            if ($html) {
                $item = $item->html();
            } else {
                $item = $item->text();
            }

            $output[] = trim($item);
        }

        return $output;
    }
}