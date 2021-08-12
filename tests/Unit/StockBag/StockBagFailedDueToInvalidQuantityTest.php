<?php

namespace Tests\Unit\StockBag;

use FulfillableOrders\Exceptions\InvalidStockQuantityException;
use FulfillableOrders\Values\StockBag;
use PHPUnit\Framework\TestCase;

class StockBagFailedDueToInvalidQuantityTest extends TestCase
{
    public function test()
    {
        $this->expectException(InvalidStockQuantityException::class);
        (new StockBag())->add('1', 'invalid');
    }
}