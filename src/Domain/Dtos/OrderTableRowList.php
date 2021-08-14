<?php

namespace FulfillableOrders\Domain\Dtos;

class OrderTableRowList implements RenderableRowList
{
    use ProvidesList;

    public function add(OrderTableRow $orderTableRow): self
    {
        $this->list[] = $orderTableRow;
        return $this;
    }
}