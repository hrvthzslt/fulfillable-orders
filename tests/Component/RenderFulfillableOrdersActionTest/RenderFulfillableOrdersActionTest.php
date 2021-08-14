<?php

namespace Tests\Component\RenderFulfillableOrdersActionTest;

use FulfillableOrders\Domain\Actions\RenderFulfillableOrdersAction;
use FulfillableOrders\Domain\Dtos\OrderDetails;
use FulfillableOrders\Domain\Dtos\OrderDetailsList;
use FulfillableOrders\Domain\Dtos\OrderTableRowList;
use FulfillableOrders\Domain\Presenters\OrderTablePresenter;
use PHPUnit\Framework\TestCase;

class RenderFulfillableOrdersActionTest extends TestCase
{
    public function test()
    {
        $this->expectNotToPerformAssertions();

        $orderTableRowListMock = $this->createMock(OrderTableRowList::class);
        $orderTablePresenterMock = $this->createMock(OrderTablePresenter::class);

        $orderTableRowListMock->method('add')->willReturnSelf();
        $orderTablePresenterMock->method('render');

        $renderFulfillableOrdersAction = new RenderFulfillableOrdersAction(
            $orderTableRowListMock,
            $orderTablePresenterMock
        );

        $renderFulfillableOrdersAction->handle(
            (new OrderDetailsList())->add(new OrderDetails(1, 2, 3, 4, "2021-01-01"))
        );
    }
}