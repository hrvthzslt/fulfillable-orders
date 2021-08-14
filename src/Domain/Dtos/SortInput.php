<?php

namespace FulfillableOrders\Domain\Dtos;

use FulfillableOrders\Domain\Enums\Direction;
use FulfillableOrders\Domain\Exceptions\InvalidDirectionException;

class SortInput
{
    private string $field;

    private string $direction;

    public function __construct(string $field, string $direction)
    {
        if ( ! in_array($direction, Direction::values())) {
            throw new InvalidDirectionException("{$direction} is not a valid direction, use "
                .implode(', ', Direction::values()));
        }

        $this->field = $field;
        $this->direction = $direction;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }
}