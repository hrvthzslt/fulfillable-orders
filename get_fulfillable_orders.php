<?php

require_once __DIR__.'/vendor/autoload.php';

use FulfillableOrders\Application\Console\Commands\RenderFulfillableOrdersCommand;
use FulfillableOrders\Domain\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Domain\Actions\RenderFulfillableOrdersAction;
use FulfillableOrders\Domain\Dtos\OrderTableRowList;
use FulfillableOrders\Domain\Exceptions\AmbiguousNumberOfParametersException;
use FulfillableOrders\Domain\Exceptions\InvalidStockQuantityException;
use FulfillableOrders\Domain\Presenters\OrderTablePresenter;
use FulfillableOrders\Domain\Services\Collection\OrderCollectionFactory;
use FulfillableOrders\Domain\Services\Reader\CsvReader;

$renderFulfillableOrdersCommand = new RenderFulfillableOrdersCommand(
    new GetFulfillableOrdersAction(
        new CsvReader(),
        new OrderCollectionFactory()
    ),
    new RenderFulfillableOrdersAction(new OrderTableRowList(), new OrderTablePresenter()));

try {
    $renderFulfillableOrdersCommand->handle($argv, 'orders.csv');
} catch (AmbiguousNumberOfParametersException | InvalidStockQuantityException $e) {
    echo $e->getMessage();
    exit(1);
}