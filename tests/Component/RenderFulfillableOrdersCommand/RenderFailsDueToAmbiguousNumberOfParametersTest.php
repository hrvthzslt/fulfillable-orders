<?php

namespace Tests\Component\RenderFulfillableOrdersCommand;

use FulfillableOrders\Application\Console\Commands\RenderFulfillableOrdersCommand;
use FulfillableOrders\Domain\Exceptions\AmbiguousNumberOfParametersException;

class RenderFailsDueToAmbiguousNumberOfParametersTest extends AbstractRenderFulfilledOrdersTest
{
    public function test()
    {
        $renderFulfillableOrders = new RenderFulfillableOrdersCommand(
            $this->getFulfillableOrdersActionMock,
            $this->renderFulfillableOrdersAction
        );

        $this->expectException(AmbiguousNumberOfParametersException::class);

        $renderFulfillableOrders->handle(['1'], 'path');
    }
}