<?php

namespace FulfillableOrders\Domain\Services\Collection;

use FulfillableOrders\Domain\Dtos\SortList;
use FulfillableOrders\Domain\Enums\Direction;

class Collection implements FilterableAndSortableInterface
{
    protected array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function sort(SortList $sortList): self
    {
        usort($this->items, function ($a, $b) use ($sortList) {
            $aSet = [];
            $bSet = [];

            foreach ($sortList->getList() as $field => $direction) {
                $aSet[] = $direction === Direction::ASC ? [$a[$field]] : [$b[$field]];
                $bSet[] = $direction === Direction::ASC ? [$b[$field]] : [$a[$field]];
            }

            return $aSet <=> $bSet;
        });

        return $this;
    }

    public function filter(callable $callback): self
    {
        $this->items = array_values(array_filter($this->items, $callback));

        return $this;
    }
}