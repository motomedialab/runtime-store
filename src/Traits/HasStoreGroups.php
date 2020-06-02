<?php
/**
 * @author MotoMediaLab <hello@motomedialab.com>
 * Created at: 02/06/2020
 */

namespace Motomedialab\RuntimeStore\Traits;


use Motomedialab\RuntimeStore\RuntimeStore;

/**
 * Trait HasStoreGroups.
 *
 * @mixin RuntimeStore
 */
trait HasStoreGroups
{
    /** @var RuntimeStore[] */
    protected $groups = [];

    /**
     * Create a store group.
     *
     * @param string $name
     *
     * @return RuntimeStore
     */
    public function group(string $name)
    {
        if (array_key_exists($name, $this->groups)) {
            return $this->groups[$name];
        }

        return $this->groups[$name] = new RuntimeStore;
    }

    /**
     * Checks if a group exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasGroup(string $name)
    {
        return isset($this->groups[$name]);
    }


    /**
     * Delete a group store.
     *
     * @param string $name
     */
    public function deleteGroup(string $name)
    {
        if ($this->hasGroup($name)) {
            unset($this->groups[$name]);
        }
    }

}
