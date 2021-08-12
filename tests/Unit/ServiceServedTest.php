<?php

namespace Tests\Unit;

use FulfillableOrders\Domain\Services\Service;
use PHPUnit\Framework\TestCase;

class ServiceServedTest extends TestCase
{
    public function test()
    {
        $this->assertEquals("served", (new Service())->serve());
    }
}