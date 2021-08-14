<?php

namespace FulfillableOrders\Domain\Dtos;

class OrderDetailsList
{
    use ProvidesList;

    public function add(OrderDetails $orderDetails): self
    {
        $this->list[] = $orderDetails;
        return $this;
    }
}