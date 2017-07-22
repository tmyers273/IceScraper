<?php

namespace tmyers273\IceScraper\Contracts;

interface ScraperResponse {

    public function __construct($source);

    public function getSource();

    public function getCrawler();

    public function xpath($xpath, $default = null, $html = false);

    public function xpathMultiple($xpath, $default = null, $html = false);

}