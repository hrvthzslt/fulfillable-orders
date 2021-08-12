<?php

namespace Tests\Component\RenderFulfilledOrders;

use FulfillableOrders\Application\Console\Commands\RenderFulfillableOrdersCommand;
use FulfillableOrders\Domain\Exceptions\AmbiguousNumberOfParametersException;

class RenderFailsDueToAmbiguousNumberOfParametersTest extends AbstractRenderFulfilledOrdersTest
{

    public function test()
    {
        $renderFulfillableOrders = new RenderFulfillableOrdersCommand(
            $this->getFulfillableOrdersActionMock,
            $this->orderTablePresenterMock
        );

        $this->expectException(AmbiguousNumberOfParametersException::class);

        $renderFulfillableOrders->handle(['1'], 'path');
    }

}