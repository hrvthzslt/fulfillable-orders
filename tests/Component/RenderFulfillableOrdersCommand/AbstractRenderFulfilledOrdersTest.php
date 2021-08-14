<?php

namespace Tests\Component\RenderFulfillableOrdersCommand;

use FulfillableOrders\Domain\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Domain\Actions\RenderFulfillableOrdersAction;
use PHPUnit\Framework\TestCase;

abstract class AbstractRenderFulfilledOrdersTest extends TestCase
{
    protected $getFulfillableOrdersActionMock;

    protected $renderFulfillableOrdersAction;

    public function setUp(): void
    {
        $this->getFulfillableOrdersActionMock = $this->createMock(GetFulfillableOrdersAction::class);
        $this->renderFulfillableOrdersAction = $this->createMock(RenderFulfillableOrdersAction::class);
    }
}