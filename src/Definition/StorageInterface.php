<?php

namespace Rapture\Auth\Definition;

/**
 * Data source interface
 *
 * @package Rapture\Auth
 * @author  Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
interface StorageInterface
{
    /**
     * Get
     *
     * @param string $key Key name
     *
     * @return UserInterface
     */
    public function get($key);

    /**
     * Set
     *
     * @param string $name  Key name
     * @param mixed  $value Value
     *
     * @return UserInterface
     */
    public function set($name, $value);

    /**
     * Delete
     *
     * @param string $key Key name
     *
     * @return bool
     */
    public function delete($key);
}
