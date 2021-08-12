<?php

namespace Tests\Unit\StockBag;

use FulfillableOrders\Domain\Values\StockBag;
use PHPUnit\Framework\TestCase;

class StockBagCreatedTest extends TestCase
{
    public function test()
    {
        $sortBag = (new StockBag())->add('2', 1)->add('3', 4);

        $expectedBag = [2 => 1, 3 => 4];

        $this->assertEquals($expectedBag, $sortBag->getBag());
    }
}