<?php

namespace FulfillableOrders\Domain\Dtos;

trait ProvidesList
{
    private array $list = [];

    public function getList(): array
    {
        return $this->list;
    }
}