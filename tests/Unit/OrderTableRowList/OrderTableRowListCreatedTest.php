<?php

namespace Tests\Unit\OrderTableRowList;

use FulfillableOrders\Domain\Dtos\OrderTableRow;
use FulfillableOrders\Domain\Dtos\OrderTableRowList;
use PHPUnit\Framework\TestCase;

class OrderTableRowListCreatedTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param  array  $firstRow
     * @param  array  $secondRow
     */
    public function test(array $firstRow, array $secondRow)
    {
        $orderTableRowList = (new OrderTableRowList())->add(new OrderTableRow(
            $firstRow['productId'],
            $firstRow['quantity'],
            $firstRow['priority'],
            $firstRow['date']
        ))->add(new OrderTableRow(
            $secondRow['productId'],
            $secondRow['quantity'],
            $secondRow['priority'],
            $secondRow['date']
        ));

        $this->assertIsArray($orderTableRowList->getList());
        $this->assertCount(2, $orderTableRowList->getList());
    }

    public function dataProvider(): array
    {
        return [
            'Row list #1' => [
                'firstRow'  => [
                    'productId' => 1,
                    'quantity'  => 2,
                    'priority'  => 3,
                    'date'      => '2021-03-23 05:01:29',
                ],
                "secondRow" => [
                    'productId' => 43,
                    'quantity'  => 876,
                    'priority'  => 1,
                    'date'      => '2021-03-23 05:01:29',
                ],
            ],
            'Row list #2' => [
                'firstRow'  => [
                    'productId' => 463,
                    'quantity'  => 23,
                    'priority'  => 2,
                    'date'      => '2019-03-23 05:01:29',
                ],
                "secondRow" => [
                    'productId' => 65,
                    'quantity'  => 1,
                    'priority'  => 2,
                    'date'      => '2000-03-23 05:01:29',
                ],
            ],
        ];
    }
}