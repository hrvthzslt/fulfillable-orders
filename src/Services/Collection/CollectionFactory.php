<?php

namespace FulfillableOrders\Services\Collection;

class CollectionFactory
{
    public function create(array $items, string $collectionClass): FilterableAndSortableInterface
    {
        return new $collectionClass($items);
    }
}