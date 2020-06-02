<?php
/**
 * @author MotoMediaLab <hello@motomedialab.com>
 * Created at: 02/06/2020
 */

namespace Motomedialab\RuntimeStore\Tests;


use Motomedialab\RuntimeStore\RuntimeStore;
use PHPUnit\Framework\TestCase;

class RuntimeStoreGroupTest extends TestCase
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
    function groups_can_be_created()
    {
        $this->assertInstanceOf(RuntimeStore::class, $this->store->group('testing'));
    }

    /**
     * @test
     **/
    function groups_can_persist_values()
    {
        $this->store->group('testing')->set('testing', 'value');

        $this->assertEquals('value', $this->store->group('testing')->get('testing'));
    }

    /**
     * @test
     **/
    function groups_do_not_influence_primary_store()
    {
        $this->store->group('testing')->set('testing', 'value');

        $this->assertFalse($this->store->get('testing', false));
    }

    /**
     * @test
     **/
    function groups_can_be_deleted()
    {
        $this->store->group('testing');
        $this->assertTrue($this->store->hasGroup('testing'));

        $this->store->deleteGroup('testing');
        $this->assertFalse($this->store->hasGroup('testing'));
    }

}
