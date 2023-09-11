<?php
 
use App\Entity\Order;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testGetId()
    {
        $order = new Order();
        $this->assertNull($order->getId());

    }

    public function testGetTotalPrice()
    {
        $order = new Order();
        $order->setTotalPrice(100.0);
        $this->assertEquals(100.0, $order->getTotalPrice());
    }

    public function testGetUser()
    {
        $order = new Order();
        $user = new User();
        $order->setUser($user);
        $this->assertInstanceOf(User::class, $order->getUser());
    }

    public function testGetOrderDate()
    {
        $order = new Order();
        $date = new \DateTime('2023-09-10');
        $order->setOrderDate($date);
        $this->assertEquals($date, $order->getOrderDate());
    }

    public function testGetOrderDateWithNull()
    {
        $order = new Order();
        $this->assertNull($order->getOrderDate());
    }
    
}
