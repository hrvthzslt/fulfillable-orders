<?php

namespace Tests\Integration\Collection;

use FulfillableOrders\Domain\Enums\Direction;
use FulfillableOrders\Domain\Services\Collection\Collection;
use FulfillableOrders\Domain\Values\SortBag;

class SortCollectionTest extends AbstractCollectionTest
{
    public function test()
    {
        $collection = new Collection($this->itemsToCollect);

        $collection->sort((new SortBag())->add('quantity', Direction::DESC)->add('letter', Direction::ASC));

        $expectedItems = [
            ['quantity' => '3', 'letter' => 'E'],
            ['quantity' => '3', 'letter' => 'F'],
            ['quantity' => '2', 'letter' => 'D'],
            ['quantity' => '1', 'letter' => 'A'],
            ['quantity' => '1', 'letter' => 'B'],
            ['quantity' => '1', 'letter' => 'C'],
        ];

        $this->assertEquals($expectedItems, $collection->getItems());
    }
}