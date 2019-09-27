<?php

namespace Motomedialab\RuntimeStore;

use Closure;

class RuntimeStore
{
    private $store = [];

    /**
     * Set a value against our store.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function set($key, $value)
    {
        $this->store[$key] = $value instanceof Closure
            ? $value() : $value;

        return $this->store[$key];
    }

    /**
     * Alias of set.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function put($key, $value)
    {
        return $this->set($key, $value);
    }

    /**
     * Alias of set.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function add($key, $value)
    {
        return $this->set($key, $value);
    }

    /**
     * Increment a stored value.
     *
     * @param string $key
     * @param int $incrementBy
     *
     * @return bool|int|mixed
     */
    public function increment($key, $incrementBy = 1)
    {
        if ($this->has($key) && is_numeric($this->get($key))) {
            return $this->set($key, $this->get($key) + $incrementBy);
        }

        return $this->set($key, $incrementBy);
    }

    /**
     * Decrement a stored value.
     *
     * @param string $key
     * @param int $decrementBy
     *
     * @return bool|int|mixed
     */
    public function decrement($key, $decrementBy = 1)
    {
        if ($this->has($key) && is_numeric($this->get($key))) {
            return $this->set($key, $this->get($key) - $decrementBy);
        }

        return $this->set($key, $decrementBy);
    }

    /**
     * Set a value to our store, or return the existing value
     * if already available within the store.
     *
     * @param string  $key
     * @param Closure $value
     *
     * @return mixed
     */
    public function remember($key, Closure $value)
    {
        if ($this->has($key)) {
            return $this->get($key);
        }

        return $this->set($key, $value);
    }

    /**
     * Retrieve a value from our store.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = false)
    {
        if ($this->has($key)) {
            return $this->store[$key];
        }

        return $default;
    }

    /**
     * Determine if our store already has a particular value.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->store);
    }

    /**
     * Remove one or more values from our store.
     *
     * @param string|array $keys
     *
     * @return $this
     */
    public function forget($keys)
    {
        $keys = is_array($keys) ? $keys : [$keys];

        foreach ($keys as $key) {
            if ($this->has($key)) {
                unset($this->store[$key]);
            }
        }

        return $this;
    }

    /**
     * Alias of forget.
     *
     * @param string $key
     */
    public function delete($key)
    {
        $this->forget($key);
    }

    /**
     * Clear all cached values.
     *
     * @return $this
     */
    public function clear()
    {
        $this->store = [];

        return $this;
    }

    /**
     * Retrieve an item from the store and delete it.
     *
     * @param      $key
     * @param bool $default
     *
     * @return bool|mixed
     */
    public function pull($key, $default = false)
    {
        if ($this->has($key)) {
            $return = $this->get($key, $default);
            $this->delete($key);

            return $return;
        }

        return $default;
    }
}
