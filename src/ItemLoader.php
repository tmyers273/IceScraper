<?php

namespace tmyers273\IceScraper;

use Symfony\Component\DomCrawler\Crawler;
use tmyers273\IceScraper\Strategies\XPathMultipleStrategy;
use tmyers273\IceScraper\Strategies\XPathStrategy;

// @todo test with multiple strategies for same item
class ItemLoader {

    protected $item;
    protected $response;
    protected $strategies = [];

    public function __construct(ScraperItem $item, ScraperResponse $response)
    {
        $this->item = $item;
        $this->response = $response;
    }

    public function addCollectionByXpath($name, $xpath, callable $callback)
    {
        $crawler = $this->response->getCrawler();
        $elements = $crawler->filterXPath($xpath);

        $items = [];
        foreach($elements as $element) {
            $element = new ScraperResponse($element);
            $items[] = $callback($element);
        }

        $this->item->set($name, $items);
        return $this;
    }

    public function addXpath($name, $xpath, $default = null)
    {
        $this->strategies[] = new XPathStrategy($this->response, $name, $xpath, $default);
    }

    public function addXPathMultiple($name, $xpath, $default = null)
    {
        $this->strategies[] = new XPathMultipleStrategy($this->response, $name, $xpath, $default);
    }

    public function resolve()
    {
        foreach($this->strategies as $strategy) {
            $result = $strategy->handle();

            $this->item->set($strategy->getName(), $result);
        }

        return $this;
    }

    public function getItem()
    {
        return $this->item;
    }

}