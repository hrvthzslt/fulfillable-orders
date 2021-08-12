<?php

namespace Tests\Component\GetFulfillableOrders;

use FulfillableOrders\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Services\Collection\CollectionFactory;
use FulfillableOrders\Services\Reader\CsvContent;
use FulfillableOrders\Services\Reader\CsvReader;
use PHPUnit\Framework\TestCase;

class ReturnsFulfilabbleOrdersActionTest extends TestCase
{
    public function test()
    {
        $reader = $this->createMock(CsvReader::class);
        $reader->method('readFile')->willReturn(new CsvContent(
            ['product_id', 'quantity', 'priority', 'created_at'],
            [
                ['1', '2', '3', '2021-03-25 14:51:47'],
                ['2', '1', '2', '2021-03-21 14:00:26'],
                ['2', '4', '1', '2021-03-22 17:41:32'],
            ]
        ));

        $action = new GetFulfillableOrdersAction($reader, new CollectionFactory());
        $items = $action->handle('a', [2 => 4]);

        $expectedItems = [
            [
                "product_id" => "2",
                "quantity"   => "1",
                "priority"   => "2",
                "created_at" => "2021-03-21 14:00:26",
            ],
            [
                "product_id" => "2",
                "quantity"   => "4",
                "priority"   => "1",
                "created_at" => "2021-03-22 17:41:32",
            ],
        ];

        $this->assertEquals($expectedItems, $items);
    }
}