<?php

namespace examples\google;

use tmyers273\IceScraper\Contracts\LoaderFactory;
use tmyers273\IceScraper\ItemLoader;
use tmyers273\IceScraper\ScraperResponse;

class GoogleResultsPageLoaderFactory implements LoaderFactory {

    public function make($source) : ItemLoader
    {
        $loader = new ItemLoader(new GoogleResultPage(), $source);

        $loader->addCollectionByXpath('items', '//*[@id="rso"]/div[2]/div/div', function(ScraperResponse $element) {
            $factory = (new GoogleResultsLoaderFactory())->make($element)->resolve();
            return $factory->getItem();
        });

        $loader->addXpath('totalResults', '//*[@id="resultStats"]');

        return $loader;
    }

}