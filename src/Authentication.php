<?php

namespace Rapture\Auth;

use Rapture\Auth\Definition\SourceInterface;
use Rapture\Auth\Definition\StorageInterface;
use Rapture\Auth\Definition\UserInterface;

/**
 * Authentication class
 *
 * @package Rapture\Auth
 * @author  Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
class Authentication
{
    const SESSION_KEY = 'rapture-user';

    /** @var SourceInterface */
    protected $source;

    /** @var StorageInterface */
    protected $storage;

    /**
     * Change provided $data parameters before fetching UserResult
     *
     * @var callable
     */
    protected $preInvoke;

    /**
     * Run this after the user result is fetched
     *
     * @var callable
     */
    protected $postInvoke;

    /**
     * @param SourceInterface  $source     Data source
     * @param StorageInterface $storage    Storage
     * @param \Callback        $preInvoke  Callback
     * @param \Callback        $postInvoke Callback
     */
    public function __construct(SourceInterface $source, StorageInterface $storage, $preInvoke = null, $postInvoke = null)
    {
        $this->source = $source;
        $this->storage = $storage;
        $this->preInvoke = $preInvoke ?: [$this, 'preCallback'];
        $this->postInvoke = $postInvoke ?: [$this, 'postCallback'];
    }

    /**
     * authenticate
     *
     * @param mixed $data Data to use for authentication
     *
     * @return bool
     */
    public function authenticate($data)
    {
        if (is_callable($this->preInvoke)) {
            $data = call_user_func($this->preInvoke, $data, $this);
        }

        $result = $this->source->fetchUser($data);

        if (is_callable($this->postInvoke)) {
            call_user_func($this->postInvoke, $result, $this);
        }

        return $result->isAuthenticated();
    }

    /**
     * deAuthenticate
     *
     * @return bool
     */
    public function deAuthenticate()
    {
        return $this->storage->delete(self::SESSION_KEY);
    }

    /**
     * preCallback
     *
     * @param array $data Auth data
     *
     * @return array
     */
    public function preCallback(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = sha1($data['password']);
        }

        if (isset($data['pass'])) {
            $data['pass'] = sha1($data['pass']);
        }

        return $data;
    }

    /**
     * postCallback
     *
     * @param mixed $result Data source result
     *
     * @return void
     */
    public function postCallback($result)
    {
        /*
        * Example:
        *
        * $result->setLoginAt(new \DateTime);
        */

        $this->storage->set(self::SESSION_KEY, $result);
    }

    /**
     * user
     *
     * @return UserInterface
     */
    public function user()
    {
        return $this->storage->get(self::SESSION_KEY) ?: $this->getSource()->fetchUser([]);
    }

    /**
     * set user
     *
     * @param UserInterface $user Session user
     *
     * @return bool
     */
    public function setUser(UserInterface $user)
    {
        return $this->storage->set(self::SESSION_KEY, $user);
    }

    /**
     * getSource
     *
     * @return SourceInterface
     */
    public function getSource():SourceInterface
    {
        return $this->source;
    }

    /**
     * getStorage
     *
     * @return StorageInterface
     */
    public function getStorage():StorageInterface
    {
        return $this->storage;
    }
}
