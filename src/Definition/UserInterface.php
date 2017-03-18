<?php

namespace Rapture\Auth\Definition;

/**
 * User result interface
 *
 * @package Rapture\Auth
 * @author  Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
interface UserInterface
{
    /**
     * getId
     *
     * @return mixed
     */
    public function getId();

    /**
     * getName
     *
     * @return string
     */
    public function getName();

    /**
     * Check if user is anonymous
     *
     * @return bool
     */
    public function isAnonymous();

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated();
}
