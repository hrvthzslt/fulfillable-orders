<?php

namespace FulfillableOrders\Domain\Values;

use FulfillableOrders\Domain\Exceptions\InvalidStockQuantityException;

class StockBag extends AbstractKeyValueBag
{
    public function add(string $key, $value = null): self
    {
        if ( ! is_int($value)) {
            throw new InvalidStockQuantityException('Stock value has to be integer');
        }

        $this->bag[$key] = $value;

        return $this;
    }
}