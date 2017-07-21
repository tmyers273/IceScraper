<?php

namespace tmyers273\IceScraper;

interface ScraperItem {

    public function set($key, $value);
    public function get($key, $default = null);
    public function keys();
    public function items();

}