<?php

namespace Tests\Integration\CollectionFactory;

use FulfillableOrders\Domain\Services\Collection\CollectionFactory;
use FulfillableOrders\Domain\Services\Collection\OrderCollection;
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