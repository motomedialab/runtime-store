<?php

use Motomedialab\RuntimeStore\RuntimeStore;

if (
    ! function_exists('store')
) {
    $store = false;

    /**
     * @return RuntimeStore
     */
    function store()
    {
        global $store;

        // Laravel implementation, if it exists.
        if (function_exists('resolve')) {
            try {
                return resolve('store');
            } catch (Exception $e) {
                // fallback...
            }
        }

        // Singleton pattern, have we already got a store?
        if ($store) {
            return $store;
        }

        // No, lets create a new store.
        return $store = new RuntimeStore;
    }
}
