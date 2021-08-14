<?php

namespace FulfillableOrders\Domain\Dtos;

class OrderDetails
{
    private int $productId;

    private int $quantity;

    private int $priority;

    private string $createdAt;

    public function __construct(int $productId, int $quantity, int $priority, string $createdAt)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->priority = $priority;
        $this->createdAt = $createdAt;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}