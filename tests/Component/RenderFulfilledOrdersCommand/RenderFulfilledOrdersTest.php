<?php

namespace Tests\Component\RenderFulfilledOrders;

use FulfillableOrders\Application\Console\Commands\RenderFulfillableOrdersCommand;
use FulfillableOrders\Domain\Dtos\OrderDetails;
use FulfillableOrders\Domain\Dtos\OrderDetailsList;

class RenderFulfilledOrdersTest extends AbstractRenderFulfilledOrdersTest
{

    public function test()
    {
        $this->expectNotToPerformAssertions();

        $this->getFulfillableOrdersActionMock->method('handle')->willReturn(
            (new OrderDetailsList())
                ->add(new OrderDetails(2, 1, 2, "2021-03-21 14:00:26"))
                ->add(new OrderDetails(2, 4, 1, "2021-03-22 17:41:32"))
        );

        $this->orderTablePresenterMock->method('render');

        $renderFulfillableOrders = new RenderFulfillableOrdersCommand(
            $this->getFulfillableOrdersActionMock,
            $this->orderTablePresenterMock
        );

        $renderFulfillableOrders->handle(['get_fulfillable_orders.php', '{"2":5}'], "path");
    }

}