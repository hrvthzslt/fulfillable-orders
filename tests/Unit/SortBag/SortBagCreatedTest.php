<?php

namespace Tests\Unit\SortBag;

use FulfillableOrders\Enums\Direction;
use FulfillableOrders\Values\SortBag;
use PHPUnit\Framework\TestCase;

class SortBagCreatedTest extends TestCase
{
    public function test()
    {
        $sortBag = (new SortBag())->add('id', Direction::DESC)->add('title', Direction::ASC);

        $expectedBag = ['id' => 'desc', 'title' => 'asc'];

        $this->assertEquals($expectedBag, $sortBag->getBag());
    }
}