<?php
/**
 * @author MotoMediaLab <hello@motomedialab.com>
 * Created at: 02/06/2020
 */

namespace Motomedialab\RuntimeStore;

use Illuminate\Support\Facades\Facade;


class RuntimeStoreFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RuntimeStore::class;
    }
}
