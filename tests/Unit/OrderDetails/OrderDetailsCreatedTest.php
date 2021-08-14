<?php

namespace Tests\Unit\OrderDetails;

use FulfillableOrders\Domain\Dtos\OrderDetails;
use PHPUnit\Framework\TestCase;

class OrderDetailsCreatedTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param  int     $productId
     * @param  int     $quantity
     * @param  int     $priority
     * @param  string  $date
     */
    public function test(int $productId, int $quantity, int $priority, string $date)
    {
        $orderDetails = new OrderDetails($productId, $quantity, $priority, $date);

        $this->assertEquals($productId, $orderDetails->getProductId());
        $this->assertEquals($quantity, $orderDetails->getQuantity());
        $this->assertEquals($priority, $orderDetails->getPriority());
        $this->assertEquals($date, $orderDetails->getCreatedAt());
    }

    public function dataProvider()
    {
        return [
            "Case #1" => [
                'productId' => 1,
                'quantity'  => 2,
                'priority'  => 3,
                'date'      => '2021-03-23 05:01:29',
            ],
            "Case #2" => [
                'productId' => 43,
                'quantity'  => 876,
                'priority'  => 1,
                'date'      => '2021-03-23 05:01:29',
            ],
        ];
    }
}