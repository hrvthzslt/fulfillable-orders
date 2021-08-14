<?php

namespace FulfillableOrders\Application\Console\Commands;

use FulfillableOrders\Domain\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Domain\Dtos\OrderTableRow;
use FulfillableOrders\Domain\Dtos\OrderTableRowList;
use FulfillableOrders\Domain\Exceptions\AmbiguousNumberOfParametersException;
use FulfillableOrders\Domain\Exceptions\InvalidStockQuantityException;
use FulfillableOrders\Domain\Presenters\RendersTableInterface;

class RenderFulfillableOrdersCommand
{
    private GetFulfillableOrdersAction $getFulfillableOrdersAction;

    private RendersTableInterface $orderTablePresenter;

    public function __construct(
        GetFulfillableOrdersAction $getFulfillableOrdersAction,
        RendersTableInterface $orderTablePresenter
    ) {
        $this->getFulfillableOrdersAction = $getFulfillableOrdersAction;
        $this->orderTablePresenter = $orderTablePresenter;
    }

    public function handle(array $arguments, string $filePath): void
    {
        if (count($arguments) !== 2) {
            throw new AmbiguousNumberOfParametersException('Ambiguous number of parameters!');
        }

        if (is_null($stockArguments = json_decode($arguments[1], true))) {
            throw new InvalidStockQuantityException('Invalid json!');
        }

        $fulfillableOrders = $this->getFulfillableOrdersAction->handle($filePath, $stockArguments);

        $orderTableRowList = new OrderTableRowList();
        array_map(function ($fulfillableOrder) use ($orderTableRowList) {
            $orderTableRowList->add(new OrderTableRow(
                $fulfillableOrder['product_id'],
                $fulfillableOrder['quantity'],
                $fulfillableOrder['priority'],
                $fulfillableOrder['created_at']));
        }, $fulfillableOrders);

        $this->orderTablePresenter->render($orderTableRowList);
    }
}