<?php

namespace FulfillableOrders\Domain\Dtos;

class StockList
{
    use ProvidesList;

    public function add(StockInput $stockInput): self
    {
        $this->list[$stockInput->getProductId()] = $stockInput->getQuantity();
        return $this;
    }
}