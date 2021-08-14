<?php

namespace FulfillableOrders\Domain\Services\Collection;

use FulfillableOrders\Domain\Dtos\SortList;

interface FilterableAndSortableInterface
{
    public function filter(callable $callback): self;

    public function sort(SortList $sortList): self;
}