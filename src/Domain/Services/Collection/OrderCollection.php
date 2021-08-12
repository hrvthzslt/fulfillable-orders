<?php

namespace FulfillableOrders\Domain\Services\Collection;

use FulfillableOrders\Domain\Values\StockBag;

class OrderCollection extends Collection
{
    public function filterByStock(StockBag $stockBag): self
    {
        $stock = $stockBag->getBag();
        $this->filter(function ($item) use ($stock) {
            $productId = (int)$item['product_id'];
            return array_key_exists($productId, $stock) && $item['quantity'] <= $stock[$productId];
        });

        return $this;
    }
}