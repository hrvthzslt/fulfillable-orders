<?php

namespace FulfillableOrders\Domain\Values;

abstract class AbstractKeyValueBag
{
    protected array $bag = [];

    abstract public function add(string $key, $value = null);

    public function getBag(): array
    {
        return $this->bag;
    }

    public function addMultiple(array $array): self
    {
        foreach ($array as $key => $value) {
            $this->add($key, $value);
        }

        return $this;
    }
}