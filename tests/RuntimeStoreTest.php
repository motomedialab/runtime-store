<?php

namespace Motomedialab\RuntimeStore\Tests;

use Motomedialab\RuntimeStore\RuntimeStore;
use PHPUnit\Framework\TestCase;

class RuntimeStoreTest extends TestCase
{
    /**
     * @test
     **/
    function store_can_set_values()
    {
        $store = new RuntimeStore;

        $store->set('test', 'value');
        $this->assertEquals('value', $store->get('test'));
    }

    /**
     * @test
     **/
    function store_can_have_default_values()
    {
        $store = new RuntimeStore;

        $this->assertEquals('unset', $store->get('test', 'unset'));
    }
}
