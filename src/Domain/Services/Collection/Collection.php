<?php

namespace FulfillableOrders\Domain\Services\Collection;

use FulfillableOrders\Domain\Enums\Direction;
use FulfillableOrders\Domain\Values\SortBag;

class Collection implements FilterableAndSortableInterface
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function sort(SortBag $sortBag): self
    {
        usort($this->items, function ($a, $b) use ($sortBag) {
            $aSet = [];
            $bSet = [];

            foreach ($sortBag->getBag() as $key => $direction) {
                $aSet[] = $direction === Direction::ASC ? [$a[$key]] : [$b[$key]];
                $bSet[] = $direction === Direction::ASC ? [$b[$key]] : [$a[$key]];
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