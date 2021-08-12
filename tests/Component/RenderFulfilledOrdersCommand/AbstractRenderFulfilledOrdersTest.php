<?php

namespace Tests\Component\RenderFulfilledOrders;

use FulfillableOrders\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Presenters\OrderTablePresenter;
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