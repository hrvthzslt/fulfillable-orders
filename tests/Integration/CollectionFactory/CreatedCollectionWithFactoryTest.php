<?php

namespace Tests\Integration\CollectionFactory;

use FulfillableOrders\Services\Collection\CollectionFactory;
use FulfillableOrders\Services\Collection\OrderCollection;
use PHPUnit\Framework\TestCase;

class CreatedCollectionWithFactoryTest extends TestCase
{
    public function test()
    {
        $collectionFactory = new CollectionFactory();

        $collectionInstance = $collectionFactory->create([], OrderCollection::class);

        $this->assertInstanceOf(OrderCollection::class, $collectionInstance);
    }
}