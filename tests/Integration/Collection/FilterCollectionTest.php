<?php

namespace Tests\Integration\Collection;

use FulfillableOrders\Services\Collection\Collection;

class FilterCollectionTest extends AbstractCollectionTest
{
    public function test()
    {
        $collection = new Collection($this->itemsToCollect);

        $collection->filter(function ($item) {
            return $item['quantity'] >= 2 && $item['letter'] !== 'E';
        });

        $expectedCollection = [
            ['quantity' => '2', 'letter' => 'D'],
            ['quantity' => '3', 'letter' => 'F'],
        ];

        $this->assertEquals($expectedCollection, $collection->getItems());
    }
}