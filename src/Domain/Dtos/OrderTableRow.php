<?php

namespace FulfillableOrders\Domain\Dtos;

use FulfillableOrders\Domain\Enums\Priority;
use FulfillableOrders\Domain\Exceptions\InvalidPriorityException;

class OrderTableRow
{
    private int $productId;

    private int $quantity;

    private string $priority;

    private string $createdAt;

    public function __construct(int $productId, int $quantity, int $priority, string $createdAt)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->setPriority($priority);
    }

    private function setPriority(int $priority)
    {
        if ( ! in_array($priority, array_keys(Priority::list()))) {
            throw new InvalidPriorityException("Given priority input {$priority} is invalid");
        }

        $this->priority = Priority::list()[$priority];
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPriority(): string
    {
        return $this->priority;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}