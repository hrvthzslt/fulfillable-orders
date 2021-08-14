<?php

namespace FulfillableOrders\Domain\Dtos;

class SortList
{
    use ProvidesList;

    public function add(SortInput $sortInput): self
    {
        $this->list[$sortInput->getField()] = $sortInput->getDirection();
        return $this;
    }
}