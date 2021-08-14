<?php

namespace FulfillableOrders\Domain\Services\Collection;

use FulfillableOrders\Domain\Dtos\OrderDetails;
use FulfillableOrders\Domain\Dtos\OrderDetailsList;
use FulfillableOrders\Domain\Dtos\StockList;

class OrderCollection extends Collection
{
    public function getOrderDetails(): OrderDetailsList
    {
        $orderDetails = new OrderDetailsList();
        array_map(function ($item) use ($orderDetails) {
            $orderDetails->add(new OrderDetails(
                $item['product_id'],
                $item['quantity'],
                $item['priority'],
                $item['created_at']
            ));
        }, $this->items);
        return $orderDetails;
    }

    public function filterByStock(StockList $stockList): self
    {
        $stockList = $stockList->getList();
        $this->filter(function ($item) use ($stockList) {
            return array_key_exists($item['product_id'], $stockList)
                && $item['quantity'] <= $stockList[$item['product_id']];
        });

        return $this;
    }
}