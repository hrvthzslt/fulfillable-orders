<?php

namespace FulfillableOrders\Services\Collection;

use FulfillableOrders\Values\SortBag;

interface FilterableAndSortableInterface
{
    public function filter(callable $callback): self;

    public function sort(SortBag $sortBag): self;
}