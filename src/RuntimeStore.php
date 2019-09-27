<?php

namespace Motomedialab\RuntimeStore;

class RuntimeStore
{
    private $store = [];

    /**
     * Set a value against our store
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function set(string $key, $value)
    {
        $this->store[$key] = is_callable($value)
            ? $value() : $value;

        return $this->store[$key];
    }

    /**
     * Unset a value from our store
     *
     * @param string $key
     *
     * @return $this
     */
    public function unset(string $key)
    {
        if (array_key_exists($key, $this->store)) {
            unset($this->store[$key]);
        }

        return $this;
    }

    /**
     * Retrieve a value from our store
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get(string $key, $default = false)
    {
        if ($this->has($key)) {
            return $this->store[$key];
        }

        return $default;
    }

    /**
     * Determine if our store already has a particular value
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key)
    {
        return array_key_exists($key, $this->store);
    }

    /**
     * Set a value to our store, or return the existing value
     * if already available within the store
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function remember(string $key, $value)
    {
        if ($this->has($key)) {
            return $this->get($key);
        }

        return $this->set($key, $value);
    }
}
