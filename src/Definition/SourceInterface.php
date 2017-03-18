<?php

namespace Rapture\Auth\Definition;

/**
 * Data source interface
 *
 * @package Rapture\Auth
 * @author  Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
interface SourceInterface
{
    /**
     * Fetch
     *
     * @param mixed $data Auth data
     *
     * @return UserInterface|null
     */
    public function fetchUser($data);
}
