<?php

namespace Motomedialab\RuntimeStore;

use Closure;
use Motomedialab\RuntimeStore\Traits\HasStoreGroups;

class RuntimeStore
{
    use HasStoreGroups;

    /**
     * Key store.
     *
     * @var array
     */
    private array $store = [];

    /**
     * Set a value against our store.
     * Core method.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function set($key, $value): mixed
    {
        $this->store[$key] = $value instanceof Closure
            ? $value() : $value;

        return $this->store[$key];
    }

    /**
     * Retrieve a value from our store.
     * Core method.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = false): mixed
    {
        if ($this->has($key)) {
            return $this->store[$key];
        }

        return $default;
    }

    /**
     * Remove one or more values from our store.
     * Core method.
     *
     * @param  string|array  $keys
     * @return $this
     */
    public function forget($keys): static
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
     * Alias of set.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function put(string $key, $value): mixed
    {
        return $this->set($key, $value);
    }

    /**
     * Alias of set.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function add(string $key, $value): mixed
    {
        return $this->set($key, $value);
    }

    /**
     * Increment a stored value.
     *
     * @param  string  $key
     * @param  int  $incrementBy
     * @return int
     */
    public function increment(string $key, $incrementBy = 1): int
    {
        if ($this->has($key) && is_numeric($this->get($key))) {
            return $this->set($key, $this->get($key) + $incrementBy);
        }

        return $this->set($key, $incrementBy);
    }

    /**
     * Decrement a stored value.
     *
     * @param  string  $key
     * @param  int  $decrementBy
     * @return int
     */
    public function decrement(string $key, $decrementBy = 1): int
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
     * @param  string  $key
     * @param  Closure  $value
     * @return mixed
     */
    public function remember(string $key, Closure $value): mixed
    {
        if ($this->has($key)) {
            return $this->get($key);
        }

        return $this->set($key, $value);
    }

    /**
     * Determine if our store already has a particular value.
     *
     * @param  string  $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->store);
    }

    /**
     * Alias of forget.
     *
     * @param  string  $key
     */
    public function delete(string $key)
    {
        $this->forget($key);
    }

    /**
     * Clear all cached values.
     *
     * @return $this
     */
    public function clear(): static
    {
        $this->store = [];

        return $this;
    }

    /**
     * Retrieve an item from the store and delete it.
     *
     * @param  string  $key
     * @param  bool  $default
     * @return mixed
     */
    public function pull(string $key, $default = false): mixed
    {
        if ($this->has($key)) {
            $return = $this->get($key, $default);
            $this->delete($key);

            return $return;
        }

        return $default;
    }
}
