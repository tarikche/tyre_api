<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetId()
    {
        $user = new User();
        $this->assertNull($user->getId());
    }

    public function testGetEmail()
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    public function testGetRoles()
    {
        $user = new User();
        $this->assertContains('ROLE_USER', $user->getRoles());

        // You can add custom roles and assert their presence
        $user->setRoles(['ROLE_ADMIN']);
        $this->assertContains('ROLE_USER', $user->getRoles());
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
    }

    public function testGetPassword()
    {
        $user = new User();
        $user->setPassword('hashed_password');
        $this->assertEquals('hashed_password', $user->getPassword());
    }
        
}
