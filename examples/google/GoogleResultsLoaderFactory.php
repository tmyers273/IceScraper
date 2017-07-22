<?php

namespace examples\google;

use tmyers273\IceScraper\Contracts\LoaderFactory;
use tmyers273\IceScraper\ItemLoader;
use tmyers273\IceScraper\ScraperResponse;

class GoogleResultsLoaderFactory implements LoaderFactory {

    public function make($source) : ItemLoader
    {
        $loader = new ItemLoader(new GoogleResult(), $source);

        $loader->addXpath('title', '//*[div]/div/h3/a');
        $loader->addXpath('citation', '//*[div]/div/div/div/div/div/cite');
        $loader->addXpath('link', '//*[div]/div/div/h3/a/@href');
        $loader->addXpath('description', '//*[div]/div/div/div/div/span');

        return $loader;
    }

}