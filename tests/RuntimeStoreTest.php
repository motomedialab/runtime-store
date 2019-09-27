<?php

namespace Motomedialab\RuntimeStore\Tests;

use PHPUnit\Framework\TestCase;
use Motomedialab\RuntimeStore\RuntimeStore;

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
    public function store_can_set_values()
    {
        $this->store->set('test', 'value');
        $this->assertEquals('value', $this->store->get('test'));
    }

    /**
     * @test
     **/
    public function put_stores_values()
    {
        $this->store->put('key', 'value');
        $this->assertEquals('value', $this->store->get('key'));
    }

    /**
     * @test
     **/
    public function add_stores_values()
    {
        $this->store->add('key', 'value');
        $this->assertEquals('value', $this->store->get('key'));
    }

    /**
     * @test
     **/
    public function store_can_forget_values()
    {
        $this->store->set('test', 'value');
        $this->assertEquals('value', $this->store->get('test'));

        $this->store->forget('test');
        $this->assertEquals('default', $this->store->get('test', 'default'));
    }

    /**
     * @test
     **/
    public function forget_can_forget_multiple_values()
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
    public function pull_forgets_value_after_retrieving()
    {
        $this->store->set('key', 'value');

        $this->assertEquals('value', $this->store->pull('key', false));
        $this->assertFalse($this->store->pull('key', false));
    }

    /**
     * @test
     **/
    public function store_can_check_it_has_value()
    {
        $this->store->set('test', false);
        $this->assertTrue($this->store->has('test'));
    }

    /**
     * @test
     **/
    public function store_can_have_default_values()
    {
        $this->assertEquals('unset', $this->store->get('test', 'unset'));
    }

    /**
     * @test
     **/
    public function remember_can_evaluate_closure()
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
    public function remember_doesnt_evaluate_functions_a_second_time()
    {
        $this->store->remember('key', function () {
            return ['value' => 'call1'];
        });

        $result = $this->store->remember('key', function () {
            return ['value' => 'call2'];
        });

        $this->assertEquals(['value' => 'call1'], $result);
    }

    /**
     * @test
     **/
    public function value_can_be_incremented()
    {
        $this->store->set('key', 104);

        $this->store->increment('key', 2);

        $this->assertEquals(106, $this->store->get('key'));
    }

    /**
     * @test
     **/
    public function increment_on_unset_initialises_value()
    {
        $this->store->increment('key', 10);
        $this->assertEquals(10, $this->store->get('key'));
    }

    /**
     * @test
     **/
    public function value_can_be_decremented()
    {
        $this->store->set('key', 104);

        $this->store->decrement('key', 2);

        $this->assertEquals(102, $this->store->get('key'));
    }

    /**
     * @test
     **/
    public function decrement_on_unset_initialises_value()
    {
        $this->store->decrement('key', 10);
        $this->assertEquals(10, $this->store->get('key'));
    }

    /**
     * @test
     **/
    public function clearing_store_empties_entire_cache()
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
