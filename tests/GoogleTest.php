<?php

namespace Tests;

use tmyers273\IceScraper\ScraperResponse;
use examples\google\GoogleResultsPageLoaderFactory;

class GoogleTest extends TestCase {

    /** @test */
    public function it_gets_titles() {
        $source = file_get_contents(__DIR__ . '/Files/GoogleSearch.html');
        $result = new ScraperResponse($source);

        $factory = (new GoogleResultsPageLoaderFactory())->make($result)->resolve();

        $searchResultPage = $factory->getItem();

        $items = $searchResultPage->get('items');

        $this->assertCount(10, $items);
    }

}