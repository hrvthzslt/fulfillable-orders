<?php

namespace FulfillableOrders\Domain\Services\Collection;

use FulfillableOrders\Domain\Services\Reader\ArrayableContentInterface;

class OrderCollectionFactory
{
    public function create(ArrayableContentInterface $content): OrderCollection
    {
        return new OrderCollection($content->toArray());
    }
}
