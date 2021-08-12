<?php

namespace Tests\Component\RenderFulfilledOrders;

use FulfillableOrders\Application\Console\Commands\RenderFulfillableOrdersCommand;
use FulfillableOrders\Domain\Exceptions\InvalidStockQuantityException;

class RenderFailsDueToInvalidJsonInputTest extends AbstractRenderFulfilledOrdersTest
{

    public function test()
    {
        $renderFulfillableOrders = new RenderFulfillableOrdersCommand(
            $this->getFulfillableOrdersActionMock,
            $this->orderTablePresenterMock
        );

        $this->expectException(InvalidStockQuantityException::class);

        $renderFulfillableOrders->handle(['1', 'asd'], 'path');
    }

}