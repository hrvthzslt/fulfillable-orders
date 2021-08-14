<?php

namespace FulfillableOrders\Domain\Actions;

use FulfillableOrders\Domain\Dtos\OrderDetailsList;
use FulfillableOrders\Domain\Dtos\OrderTableRow;
use FulfillableOrders\Domain\Dtos\OrderTableRowList;
use FulfillableOrders\Domain\Presenters\RendersTableInterface;

class RenderFulfillableOrdersAction
{
    private OrderTableRowList $orderTableRowList;

    private RendersTableInterface $orderTablePresenter;

    public function __construct(OrderTableRowList $orderTableRowList, RendersTableInterface $orderTablePresenter)
    {
        $this->orderTableRowList = $orderTableRowList;
        $this->orderTablePresenter = $orderTablePresenter;
    }

    public function handle(OrderDetailsList $orderDetailsList): void
    {
        array_map(function ($orderDetails) {
            $this->orderTableRowList->add(new OrderTableRow(
                $orderDetails->getProductId(),
                $orderDetails->getQuantity(),
                $orderDetails->getPriority(),
                $orderDetails->getCreatedAt()));
        }, $orderDetailsList->getList());

        $this->orderTablePresenter->render($this->orderTableRowList);
    }
}