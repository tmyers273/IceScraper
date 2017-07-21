<?php

namespace tmyers273\IceScraper;

abstract class AbstractScraperItem implements ScraperItem {

    protected $keys;

    public function __construct($initialValues = []) {
        $this->keys = [];

        foreach($initialValues as $key=>$value) {
            $this->keys[] = $key;
            $this->$key = $value;
        }
    }

    public function set($key, $value) {
        $this->$key = $value;

        if (! in_array($key, $this->keys)) {
            $this->keys[] = $key;
        }

        return $this;
    }

    public function mutate($key, callable $function)
    {
        $this->$key = $function($this->$key);
    }

    public function get($key, $default = null) {
        $result = $this->$key;

        if (empty($result)) {
            $result = $default;
        }

        return $result;
    }

    public function keys() {
        return $this->keys;
    }

    public function items() {
        $output = [];

        foreach($this->keys as $key) {
            $output[$key] = $this->$key;
        }

        return $output;
    }

}