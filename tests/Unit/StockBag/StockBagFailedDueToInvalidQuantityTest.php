<?php

namespace Tests\Unit\StockBag;

use FulfillableOrders\Domain\Exceptions\InvalidStockQuantityException;
use FulfillableOrders\Domain\Values\StockBag;
use PHPUnit\Framework\TestCase;

class StockBagFailedDueToInvalidQuantityTest extends TestCase
{
    public function test()
    {
        $this->expectException(InvalidStockQuantityException::class);
        (new StockBag())->add('1', 'invalid');
    }
}