<?php

namespace Tests\Integration\OrderCollectionFactory;

use FulfillableOrders\Domain\Services\Collection\OrderCollection;
use FulfillableOrders\Domain\Services\Collection\OrderCollectionFactory;
use FulfillableOrders\Domain\Services\Reader\CsvContent;
use PHPUnit\Framework\TestCase;

class CreatedOrderCollectionWithFactoryTest extends TestCase
{
    public function test()
    {
        $collectionFactory = new OrderCollectionFactory();

        $collectionInstance = $collectionFactory->create(new CsvContent([], []));

        $this->assertInstanceOf(OrderCollection::class, $collectionInstance);
    }
}