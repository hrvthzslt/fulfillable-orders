<?php

namespace Tests\Unit\StockInput;

use FulfillableOrders\Domain\Dtos\StockInput;
use PHPUnit\Framework\TestCase;

class StockInputCreatedTest extends TestCase
{
    /**
     * @dataProvider stockInputDataProvider
     *
     * @param  int  $productId
     * @param  int  $quantity
     */
    public function test(int $productId, int $quantity)
    {
        $stockInput = new StockInput($productId, $quantity);

        $this->assertEquals($productId, $stockInput->getProductId());
        $this->assertEquals($quantity, $stockInput->getQuantity());
    }

    public function stockInputDataProvider(): array
    {
        return [
            'Stock input #1' => [
                'productId' => 2,
                'quantity'  => 4,
            ],
            'Stock input #2' => [
                'productId' => 45,
                'quantity'  => 11,
            ],
        ];
    }
}