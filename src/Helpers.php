<?php

use Motomedialab\RuntimeStore\RuntimeStore;

if (!function_exists('store')) {
    /**
     * @return RuntimeStore
     */
    function store()
    {
        return resolve('store');
    }
}
