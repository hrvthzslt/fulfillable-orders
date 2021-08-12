<?php

namespace FulfillableOrders\Domain\Values;

use FulfillableOrders\Domain\Enums\Direction;
use FulfillableOrders\Domain\Exceptions\InvalidDirectionException;

class SortBag extends AbstractKeyValueBag
{
    public function add(string $key, $value = null): self
    {
        if ( ! in_array($value, Direction::values())) {
            throw new InvalidDirectionException("{$value} is not a valid direction, use "
                .implode(', ', Direction::values()));
        }

        $this->bag[$key] = $value;

        return $this;
    }
}