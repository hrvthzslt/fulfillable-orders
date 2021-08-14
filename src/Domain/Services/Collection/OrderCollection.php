<?php

namespace FulfillableOrders\Domain\Services\Collection;

use FulfillableOrders\Domain\Dtos\StockList;

class OrderCollection extends Collection
{
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