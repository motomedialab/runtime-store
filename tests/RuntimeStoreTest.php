<?php

namespace Motomedialab\RuntimeStore\Tests;

use Motomedialab\RuntimeStore\RuntimeStore;
use PHPUnit\Framework\TestCase;

class RuntimeStoreTest extends TestCase
{
    /** @var RuntimeStore */
    public $store;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = new RuntimeStore;
    }

    /**
     * @test
     **/
    function store_can_set_values()
    {
        $this->store->set('test', 'value');
        $this->assertEquals('value', $this->store->get('test'));
    }

    /**
 * @test
 **/
    function put_stores_values()
    {
        $this->store->put('key', 'value');
        $this->assertEquals('value', $this->store->get('key'));
    }

    /**
     * @test
     **/
    function add_stores_values()
    {
        $this->store->add('key', 'value');
        $this->assertEquals('value', $this->store->get('key'));
    }

    /**
     * @test
     **/
    function store_can_forget_values()
    {
        $this->store->set('test', 'value');
        $this->assertEquals('value', $this->store->get('test'));

        $this->store->forget('test');
        $this->assertEquals('default', $this->store->get('test', 'default'));
    }

    /**
     * @test
     **/
    function forget_can_forget_multiple_values()
    {
        $keys = ['key1', 'key2', 'key3'];
        foreach ($keys as $key) {
            $this->store->set($key, 'value');
        }

        $this->store->forget(['key2', 'key3']);

        foreach ($keys as $i => $key) {
            if (0 === $i) {
                $this->assertEquals('value', $this->store->get($key));
            } else {
                $this->assertFalse($this->store->get($key, false));
            }
        }
    }

    /**
     * @test
     **/
    function pull_forgets_value_after_retrieving()
    {
        $this->store->set('key', 'value');

        $this->assertEquals('value', $this->store->pull('key', false));
        $this->assertFalse($this->store->pull('key', false));
    }

    /**
     * @test
     **/
    function store_can_check_it_has_value()
    {
        $this->store->set('test', false);
        $this->assertTrue($this->store->has('test'));
    }

    /**
     * @test
     **/
    function store_can_have_default_values()
    {
        $this->assertEquals('unset', $this->store->get('test', 'unset'));
    }

    /**
     * @test
     **/
    function store_can_evaluate_closure()
    {
        $value = ['test1', 'test2'];
        $this->store->remember('key', function () use ($value) {
            return $value;
        });

        $this->assertEquals($value, $this->store->get('key'));
    }

    /**
     * @test
     **/
    function value_can_be_incremented()
    {
        $this->store->set('key', 104);

        $this->store->increment('key', 2);

        $this->assertEquals(106, $this->store->get('key'));
    }

    /**
     * @test
     **/
    function value_can_be_decremented()
    {
        $this->store->set('key', 104);

        $this->store->decrement('key', 2);

        $this->assertEquals(102, $this->store->get('key'));
    }

    /**
     * @test
     **/
    function clearing_store_empties_entire_cache()
    {
        foreach ($keys = ['test1', 'test2', 'test3'] as $key) {
            $this->store->set($key, 'value');
        }

        $this->store->clear();

        foreach ($keys as $key) {
            $this->assertFalse($this->store->get($key, false));
        }
    }
}
