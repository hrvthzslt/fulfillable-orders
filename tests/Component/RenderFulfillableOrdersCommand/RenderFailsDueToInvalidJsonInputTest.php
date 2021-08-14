<?php

namespace Tests\Component\RenderFulfillableOrdersCommand;

use FulfillableOrders\Application\Console\Commands\RenderFulfillableOrdersCommand;
use FulfillableOrders\Domain\Exceptions\InvalidStockQuantityException;

class RenderFailsDueToInvalidJsonInputTest extends AbstractRenderFulfilledOrdersTest
{
    public function test()
    {
        $renderFulfillableOrders = new RenderFulfillableOrdersCommand(
            $this->getFulfillableOrdersActionMock,
            $this->renderFulfillableOrdersAction
        );

        $this->expectException(InvalidStockQuantityException::class);

        $renderFulfillableOrders->handle(['1', 'asd'], 'path');
    }
}