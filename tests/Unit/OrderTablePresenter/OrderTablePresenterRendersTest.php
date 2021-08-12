<?php

namespace Tests\Unit\OrderTablePresenter;

use FulfillableOrders\Presenters\OrderTablePresenter;
use PHPUnit\Framework\TestCase;

class OrderTablePresenterRendersTest extends TestCase
{
    public function test()
    {
        $this->expectOutputRegex("/product_id          quantity            priority            created_at          /");
        $this->expectOutputRegex("/================================================================================/");
        $this->expectOutputRegex("/1                   2                   high                1994-02-13 10:01:23 /");
        $this->expectOutputRegex("/2                   1                   medium              1994-02-13 10:01:23 /");

        (new OrderTablePresenter())->render([
            [
                'product_id' => 1,
                'quantity'   => 2,
                'priority'   => 3,
                'created_at' => '1994-02-13 10:01:23',
            ],
            [
                'product_id' => 2,
                'quantity'   => 1,
                'priority'   => 2,
                'created_at' => '1994-02-13 10:01:23',
            ],
        ]);
    }
}