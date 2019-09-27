<?php

namespace Motomedialab\RuntimeStore\Tests;

use Motomedialab\RuntimeStore\RuntimeStore;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{

    /**
     * @test
     **/
    function singleton_can_be_loaded()
    {
        $this->assertInstanceOf(RuntimeStore::class, $store = app('store'));

        $store->set('test', 'value');

        $this->assertEquals('value', $store->get('test'));
    }

    /**
     * @test
     **/
    function helpers_can_be_loaded()
    {
        $this->assertInstanceOf(RuntimeStore::class, store());

        store()->set('test', 'value');

        $this->assertEquals('value', store()->get('test'));
    }

}
