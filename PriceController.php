<?php

namespace APP\Controllers;

class PriceController
{
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function showPrice()
    {
        echo "The price is $100";
    }
}
