<?php

require_once __DIR__.'/vendor/autoload.php';

use FulfillableOrders\Application\Console\Commands\RenderFulfillableOrdersCommand;
use FulfillableOrders\Domain\Actions\GetFulfillableOrdersAction;
use FulfillableOrders\Domain\Exceptions\AmbiguousNumberOfParametersException;
use FulfillableOrders\Domain\Exceptions\InvalidStockQuantityException;
use FulfillableOrders\Domain\Presenters\OrderTablePresenter;
use FulfillableOrders\Domain\Services\Collection\CollectionFactory;
use FulfillableOrders\Domain\Services\Reader\CsvReader;

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