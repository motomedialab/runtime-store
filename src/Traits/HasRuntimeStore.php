<?php
/**
 * @author MotoMediaLab <hello@motomedialab.com>
 * Created at: 02/06/2020
 */

namespace Motomedialab\RuntimeStore\Traits;

use Motomedialab\RuntimeStore\RuntimeStore;

/**
 * Trait HasRuntimeStore.
 */
trait HasRuntimeStore
{
    public function store(): RuntimeStore
    {
        return store()->group(static::class);
    }
}
