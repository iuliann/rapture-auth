<?php

namespace Rapture\Auth;

use Rapture\Auth\Definition\SourceInterface;
use Rapture\Auth\Definition\UserInterface;

/**
 * Dummy auth User class
 *
 * @package Rapture\Auth
 * @author Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
class User implements UserInterface, SourceInterface
{
    /**
     * getId
     *
     * @return mixed
     */
    public function getId()
    {
        return 0;
    }

    /**
     * getName
     *
     * @return string
     */
    public function getName()
    {
        return 'User';
    }

    /**
     * Check if user is anonymous
     *
     * @return bool
     */
    public function isAnonymous()
    {
        return true;
    }

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        return false;
    }

    /**
     * Fetch
     *
     * @param mixed $data Auth data
     *
     * @return UserInterface
     */
    public function fetchUser($data)
    {
        return new User();
    }
}
