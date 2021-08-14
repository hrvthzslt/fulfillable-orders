<?php

namespace Tests\Unit\SortInput;

use FulfillableOrders\Domain\Dtos\SortInput;
use FulfillableOrders\Domain\Exceptions\InvalidDirectionException;
use PHPUnit\Framework\TestCase;

class SortInputFailedDueToInvalidDirectionTest extends TestCase
{
    public function test()
    {
        $this->expectException(InvalidDirectionException::class);

        new SortInput('field', 'invalid');
    }
}