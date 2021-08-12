<?php

namespace FulfillableOrders\Domain\Services\Collection;

use FulfillableOrders\Domain\Values\SortBag;

interface FilterableAndSortableInterface
{
    public function filter(callable $callback): self;

    public function sort(SortBag $sortBag): self;
}