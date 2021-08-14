<?php

namespace FulfillableOrders\Application\Console\Commands;

use FulfillableOrders\Domain\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Domain\Actions\RenderFulfillableOrdersAction;
use FulfillableOrders\Domain\Exceptions\AmbiguousNumberOfParametersException;
use FulfillableOrders\Domain\Exceptions\InvalidStockQuantityException;

class RenderFulfillableOrdersCommand
{
    private GetFulfillableOrdersAction $getFulfillableOrdersAction;

    private RenderFulfillableOrdersAction $renderFulfillableOrdersAction;

    public function __construct(
        GetFulfillableOrdersAction $getFulfillableOrdersAction,
        RenderFulfillableOrdersAction $renderFulfillableOrdersAction
    ) {
        $this->getFulfillableOrdersAction = $getFulfillableOrdersAction;
        $this->renderFulfillableOrdersAction = $renderFulfillableOrdersAction;
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

        $this->renderFulfillableOrdersAction->handle($fulfillableOrders);
    }
}