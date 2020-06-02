<?php

use Motomedialab\RuntimeStore\RuntimeStore;

if (
    !function_exists('store')
    && method_exists('resolve')
) {
    /**
     * @return RuntimeStore
     */
    function store()
    {
        return resolve('store');
    }
}
