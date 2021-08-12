<?php

namespace Tests\Component\RenderFulfilledOrders;

use FulfillableOrders\Application\Commands\RenderFulfillableOrdersCommand;

class RenderFulfilledOrdersTest extends AbstractRenderFulfilledOrdersTest
{

    public function test()
    {
        $this->expectNotToPerformAssertions();

        $this->getFulfillableOrdersActionMock->method('handle')->willReturn([
            [
                "product_id" => "2",
                "quantity"   => "1",
                "priority"   => "2",
                "created_at" => "2021-03-21 14:00:26",
            ],
            [
                "product_id" => "2",
                "quantity"   => "4",
                "priority"   => "1",
                "created_at" => "2021-03-22 17:41:32",
            ],
        ]);

        $this->orderTablePresenterMock->method('render');

        $renderFulfillableOrders = new RenderFulfillableOrdersCommand(
            $this->getFulfillableOrdersActionMock,
            $this->orderTablePresenterMock
        );

        $renderFulfillableOrders->handle(['get_fulfillable_orders.php', '{"2":5}'], "path");
    }

}