<?php

namespace Tests\Integration\Collection;

use FulfillableOrders\Domain\Dtos\StockInput;
use FulfillableOrders\Domain\Dtos\StockList;
use FulfillableOrders\Domain\Services\Collection\OrderCollection;
use PHPUnit\Framework\TestCase;

class FilterOrderCollectionByStockTest extends TestCase
{
    /**
     * @dataProvider filterOrderCollectionByStockDataProvider
     *
     * @param  array  $itemsToCollect
     * @param  array  $expectedItems
     * @param  int    $productId
     * @param  int    $quantity
     */
    public function test(array $itemsToCollect, array $expectedItems, int $productId, int $quantity)
    {
        $collection = new OrderCollection($itemsToCollect);

        $stockList = (new StockList())->add(new StockInput($productId, $quantity));

        $filteredItems = $collection->filterByStock($stockList)->getItems();

        $this->assertEquals($expectedItems, $filteredItems);
    }

    public function filterOrderCollectionByStockDataProvider(): array
    {
        return [
            'Filter items by stock with result'    => [
                'itemsToCollect' => [
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
                ],
                'expectedItems'  => [
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
                ],
                'productId'      => 2,
                'quantity'       => 4,
            ],
            'Filter items by stock with no result' => [
                'itemsToCollect' => [
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
                ],
                'expectedItems'  => [
                ],
                'productId'      => 6,
                'quantity'       => 1,
            ],
        ];
    }
}