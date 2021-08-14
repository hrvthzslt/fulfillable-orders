<?php

namespace Tests\Component\GetFulfillableOrdersActions;

use FulfillableOrders\Domain\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Domain\Dtos\OrderDetails;
use FulfillableOrders\Domain\Dtos\OrderDetailsList;
use FulfillableOrders\Domain\Services\Collection\OrderCollectionFactory;
use FulfillableOrders\Domain\Services\Reader\CsvContent;
use FulfillableOrders\Domain\Services\Reader\CsvReader;
use PHPUnit\Framework\TestCase;

class ReturnsFulfillableOrdersActionTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param  array  $csvContentMock
     * @param  array  $expectedItems
     * @param  array  $stock
     */
    public function test(array $csvContentMock, array $expectedItems, array $stock)
    {
        $reader = $this->createMock(CsvReader::class);
        $reader->method('readFile')->willReturn(new CsvContent($csvContentMock['header'], $csvContentMock['rows']));

        $action = new GetFulfillableOrdersAction($reader, new OrderCollectionFactory());
        $items = $action->handle('a', $stock);

        $orderDetailsList = new OrderDetailsList();
        foreach ($expectedItems as $expectedItem) {
            $orderDetailsList->add($expectedItem);
        }

        $this->assertEquals($orderDetailsList->getList(), $items->getList());
    }

    public function dataProvider(): array
    {
        return [
            "Case #1" => [
                "csvContentMock" => [
                    "header" => ['product_id', 'quantity', 'priority', 'created_at'],
                    "rows" => [
                        ['1', '2', '3', '2021-03-25 14:51:47'],
                        ['2', '1', '2', '2021-03-21 14:00:26'],
                        ['2', '4', '1', '2021-03-22 17:41:32'],
                    ],
                ],
                "expectedItems" => [
                    new OrderDetails(2, 1, 2, "2021-03-21 14:00:26"),
                    new OrderDetails(2, 4, 1, "2021-03-22 17:41:32"),
                ],
                "stock" => [2 => 4],
            ],
            "Case #2" => [
                "csvContentMock" => [
                    "header" => ['product_id', 'quantity', 'priority', 'created_at'],
                    "rows" => [
                        ['1', '2', '3', '2021-03-25 14:51:47'],
                        ['2', '1', '2', '2021-03-21 14:00:26'],
                        ['2', '4', '1', '2021-03-22 17:41:32'],
                    ],
                ],
                "expectedItems" => [
                    new OrderDetails(1, 2, 3, "2021-03-25 14:51:47"),
                ],
                "stock" => [1 => 2],
            ],
        ];
    }
}