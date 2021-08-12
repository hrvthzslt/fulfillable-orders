<?php

require_once __DIR__.'/vendor/autoload.php';

use FulfillableOrders\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Application\Commands\RenderFulfillableOrdersCommand;
use FulfillableOrders\Exceptions\AmbiguousNumberOfParametersException;
use FulfillableOrders\Exceptions\InvalidStockQuantityException;
use FulfillableOrders\Presenters\OrderTablePresenter;
use FulfillableOrders\Services\Collection\CollectionFactory;
use FulfillableOrders\Services\Reader\CsvReader;

$renderFulfillableOrdersCommand = new RenderFulfillableOrdersCommand(
    new GetFulfillableOrdersAction(
        new CsvReader(),
        new CollectionFactory()
    ), new OrderTablePresenter());

try {
    $renderFulfillableOrdersCommand->handle($argv, 'orders.csv');
} catch (AmbiguousNumberOfParametersException | InvalidStockQuantityException $e) {
    echo $e->getMessage();
    exit(1);
}