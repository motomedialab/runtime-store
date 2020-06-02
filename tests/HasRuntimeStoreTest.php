<?php
/**
 * @author MotoMediaLab <hello@motomedialab.com>
 * Created at: 02/06/2020
 */

namespace Motomedialab\RuntimeStore\Tests;

use Illuminate\Database\Eloquent\Model;
use Motomedialab\RuntimeStore\RuntimeStore;
use Motomedialab\RuntimeStore\Traits\HasRuntimeStore;
use PHPUnit\Framework\TestCase;

class TestModel extends Model
{
    use HasRuntimeStore;
}

class HasRuntimeStoreTest extends TestCase
{

    /**
     * @test
     **/
    public function model_has_runtime_store()
    {
        $model = new TestModel;

        $this->assertInstanceOf(RuntimeStore::class, $model->store());
    }

}
