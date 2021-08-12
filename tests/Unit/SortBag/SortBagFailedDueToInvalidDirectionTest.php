<?php

namespace Tests\Unit\SortBag;

use FulfillableOrders\Exceptions\InvalidDirectionException;
use FulfillableOrders\Values\SortBag;
use PHPUnit\Framework\TestCase;

class SortBagFailedDueToInvalidDirectionTest extends TestCase
{
    public function test()
    {
        $this->expectException(InvalidDirectionException::class);
        (new SortBag())->add('id', 'invalid');
    }
}