<?php

namespace Tests\Unit\OrderDetailsList;

use FulfillableOrders\Domain\Dtos\OrderDetails;
use FulfillableOrders\Domain\Dtos\OrderDetailsList;
use PHPUnit\Framework\TestCase;

class OrderDetailsListCreatedTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param  array  $firstOrder
     * @param  array  $secondOrder
     */
    public function test(array $firstOrder, array $secondOrder)
    {
        $orderDetailsList = (new OrderDetailsList())->add(new OrderDetails(
            $firstOrder['productId'],
            $firstOrder['quantity'],
            $firstOrder['priority'],
            $firstOrder['date']
        ))->add(new OrderDetails(
            $secondOrder['productId'],
            $secondOrder['quantity'],
            $secondOrder['priority'],
            $secondOrder['date']
        ));

        $this->assertIsArray($orderDetailsList->getList());
        $this->assertCount(2, $orderDetailsList->getList());
    }

    public function dataProvider(): array
    {
        return [
            "Case #1" => [
                "firstOrder" => [
                    'productId' => 1,
                    'quantity' => 2,
                    'priority' => 3,
                    'date' => '2021-03-23 05:01:29',
                ],
                "secondOrder" => [
                    'productId' => 43,
                    'quantity' => 876,
                    'priority' => 1,
                    'date' => '2021-03-23 05:01:29',
                ],
            ],
            "Case #2" => [
                "firstOrder" => [
                    'productId' => 45,
                    'quantity' => 77,
                    'priority' => 2,
                    'date' => '2011-03-12 07:01:29',
                ],
                "secondOrder" => [
                    'productId' => 43,
                    'quantity' => 876,
                    'priority' => 1,
                    'date' => '2011-03-12 07:01:29',
                ],
            ],
        ];
    }
}