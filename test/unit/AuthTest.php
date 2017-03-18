<?php

class AuthTest extends \PHPUnit_Framework_TestCase
{
    public function testUser()
    {
        $user = new \Rapture\Auth\User();

        $this->assertEquals(0, $user->getId());
        $this->assertEquals('User', $user->getName());
        $this->assertFalse($user->isAuthenticated());
        $this->assertTrue($user->isAnonymous());
        $this->assertInstanceOf('Rapture\Auth\User', $user->fetchUser([]));
    }
}
