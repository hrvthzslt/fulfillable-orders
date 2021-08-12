<?php

namespace FulfillableOrders\Application\Console\Commands;

use FulfillableOrders\Domain\Actions\GetFulfillableOrdersAction;
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

        $this->orderTablePresenter->render($fulfillableOrders);
    }
}