<?php
/**
 * @author MotoMediaLab <hello@motomedialab.com>
 * Created at: 02/06/2020
 */

namespace Motomedialab\RuntimeStore\Traits;

use Illuminate\Database\Eloquent\Model;
use Motomedialab\RuntimeStore\RuntimeStore;

/**
 * Trait HasRuntimeStore.
 *
 * @mixin Model
 */
trait HasRuntimeStore
{
    public function store(): RuntimeStore
    {
        return app(RuntimeStore::class)->group(static::class);
    }
}
