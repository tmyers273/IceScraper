<?php

namespace tmyers273\IceScraper\Contracts;

use tmyers273\IceScraper\ItemLoader;

interface LoaderFactory {

    public function make($source) : ItemLoader;

}