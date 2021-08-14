<?php

namespace Tests\Integration\Collection;

use FulfillableOrders\Domain\Services\Collection\Collection;
use PHPUnit\Framework\TestCase;

class FilterCollectionTest extends TestCase
{
    /**
     * @dataProvider filterCollectionDataProvider
     *
     * @param  array     $itemsToCollect
     * @param  array     $expectedCollection
     * @param  callable  $filter
     */
    public function test(array $itemsToCollect, array $expectedCollection, callable $filter)
    {
        $collection = new Collection($itemsToCollect);

        $collection->filter($filter);

        $this->assertEquals($expectedCollection, $collection->getItems());
    }

    public function filterCollectionDataProvider(): array
    {
        return [
            "Letters with quantity filtered with result"    => [
                'itemsToCollect'     => [
                    ['quantity' => '1', 'letter' => 'A'],
                    ['quantity' => '1', 'letter' => 'B'],
                    ['quantity' => '1', 'letter' => 'C'],
                    ['quantity' => '2', 'letter' => 'D'],
                    ['quantity' => '3', 'letter' => 'E'],
                    ['quantity' => '3', 'letter' => 'F'],
                ],
                'expectedCollection' => [
                    ['quantity' => '2', 'letter' => 'D'],
                    ['quantity' => '3', 'letter' => 'F'],
                ],
                'filter'             => function ($item) {
                    return $item['quantity'] >= 2 && $item['letter'] !== 'E';
                },
            ],
            "Letters with quantity filtered with no result" => [
                'itemsToCollect'     => [
                    ['quantity' => '1', 'letter' => 'A'],
                    ['quantity' => '1', 'letter' => 'B'],
                    ['quantity' => '1', 'letter' => 'C'],
                ],
                'expectedCollection' => [
                ],
                'filter'             => function ($item) {
                    return $item['quantity'] > 1;
                },
            ],
        ];
    }
}