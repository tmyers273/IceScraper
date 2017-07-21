<?php

namespace tmyers273\IceScraper\Pipeline;

use tmyers273\IceScraper\ScraperItem;

interface Pipe {

    public function run(ScraperItem $item) : ScraperItem;

}