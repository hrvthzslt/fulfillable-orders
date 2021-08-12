<?php

namespace Tests\Integration\Collection;

use FulfillableOrders\Services\Collection\OrderCollection;
use FulfillableOrders\Values\StockBag;
use PHPUnit\Framework\TestCase;

class FilterOrderCollectionByStockTest extends TestCase
{
    public function test()
    {
        $itemsToCollect = [
            [
                "product_id" => "1",
                "quantity"   => "2",
                "priority"   => "3",
                "created_at" => "2021-03-25 14:51:47",
            ],
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

        $collection = new OrderCollection($itemsToCollect);
        $filteredItems = $collection->filterByStock((new StockBag())->addMultiple([2 => 4]))->getItems();

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

        $this->assertEquals($expectedItems, $filteredItems);
    }
}