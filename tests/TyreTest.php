<?php

use App\Entity\Tyre;
use App\Entity\Stock;
use PHPUnit\Framework\TestCase;

class TyreTest extends TestCase
{
    public function testGetId()
    {
        $tyre = new Tyre();
        $this->assertNull($tyre->getId());

    }

    public function testGetBrand()
    {
        $tyre = new Tyre();
        $tyre->setBrand('Michelin');
        $this->assertEquals('Michelin', $tyre->getBrand());
    }

    public function testGetSeason()
    {
        $tyre = new Tyre();
        $tyre->setSeason('Summer');
        $this->assertEquals('Summer', $tyre->getSeason());
    }

    public function testGetDimensions()
    {
        $tyre = new Tyre();
        $tyre->setDimensions('225/55/16');
        $this->assertEquals('225/55/16', $tyre->getDimensions());
    }
}
