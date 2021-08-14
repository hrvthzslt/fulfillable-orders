<?php

namespace Tests\Unit\OrderTableRow;

use FulfillableOrders\Domain\Dtos\OrderTableRow;
use PHPUnit\Framework\TestCase;

class OrderTableRowCreatedTest extends TestCase
{
    /**
     * @dataProvider orderTableRowCreatedDataProvider
     *
     * @param  int     $productId
     * @param  int     $quantity
     * @param  int     $priority
     * @param  string  $date
     * @param  string  $expectedPriority
     */
    public function test(int $productId, int $quantity, int $priority, string $date, string $expectedPriority)
    {
        $orderTableRow = new OrderTableRow($productId, $quantity, $priority, $date);

        $this->assertEquals($productId, $orderTableRow->getProductId());
        $this->assertEquals($quantity, $orderTableRow->getQuantity());
        $this->assertEquals($expectedPriority, $orderTableRow->getPriority());
        $this->assertEquals($date, $orderTableRow->getCreatedAt());
    }

    public function orderTableRowCreatedDataProvider()
    {
        return [
            "Case #1" => [
                'productId'        => 1,
                'quantity'         => 2,
                'priority'         => 3,
                'date'             => '2021-03-23 05:01:29',
                'expectedPriority' => 'high',
            ],
            "Case #2" => [
                'productId'        => 43,
                'quantity'         => 876,
                'priority'         => 1,
                'date'             => '2021-03-23 05:01:29',
                'expectedPriority' => 'low',
            ],
        ];
    }
}