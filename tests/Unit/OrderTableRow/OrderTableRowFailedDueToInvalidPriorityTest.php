<?php

namespace Tests\Unit\OrderTableRow;

use FulfillableOrders\Domain\Dtos\OrderTableRow;
use FulfillableOrders\Domain\Exceptions\InvalidPriorityException;
use PHPUnit\Framework\TestCase;

class OrderTableRowFailedDueToInvalidPriorityTest extends TestCase
{
    public function test()
    {
        $this->expectException(InvalidPriorityException::class);

        new OrderTableRow(1, 2, 100, "2021-02-02 14:01:01");
    }

}