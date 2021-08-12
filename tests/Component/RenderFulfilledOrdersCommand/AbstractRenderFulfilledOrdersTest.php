<?php

namespace Tests\Component\RenderFulfilledOrders;

use FulfillableOrders\Domain\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Domain\Presenters\OrderTablePresenter;
use PHPUnit\Framework\TestCase;

abstract class AbstractRenderFulfilledOrdersTest extends TestCase
{

    protected $getFulfillableOrdersActionMock;

    protected $orderTablePresenterMock;

    public function setUp(): void
    {
        $this->getFulfillableOrdersActionMock = $this->createMock(GetFulfillableOrdersAction::class);
        $this->orderTablePresenterMock = $this->createMock(OrderTablePresenter::class);
    }

}