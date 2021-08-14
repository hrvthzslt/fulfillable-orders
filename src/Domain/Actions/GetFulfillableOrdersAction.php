<?php

namespace FulfillableOrders\Domain\Actions;

use FulfillableOrders\Domain\Dtos\OrderDetailsList;
use FulfillableOrders\Domain\Dtos\SortInput;
use FulfillableOrders\Domain\Dtos\SortList;
use FulfillableOrders\Domain\Dtos\StockInput;
use FulfillableOrders\Domain\Dtos\StockList;
use FulfillableOrders\Domain\Enums\Direction;
use FulfillableOrders\Domain\Services\Collection\OrderCollectionFactory;
use FulfillableOrders\Domain\Services\Reader\ReadsFileFromPathInterface;

class GetFulfillableOrdersAction
{
    private ReadsFileFromPathInterface $reader;

    private OrderCollectionFactory $orderCollectionFactory;

    public function __construct(ReadsFileFromPathInterface $reader, OrderCollectionFactory $orderCollectionFactory)
    {
        $this->reader = $reader;
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    public function handle(string $filePath, array $stocks): OrderDetailsList
    {
        $csvContent = $this->reader->readFile($filePath);

        $orderCollection = $this->orderCollectionFactory->create($csvContent);

        $sort = (new SortList())->add(new SortInput('priority', Direction::DESC))
            ->add(new SortInput('created_at', Direction::ASC));

        $orderCollection->sort($sort);

        $stockList = new StockList();
        array_walk($stocks, function ($quantity, $productId) use ($stockList) {
            $stockList->add(new StockInput($productId, $quantity));
        });

        $orderCollection->filterByStock($stockList);

        return $orderCollection->getOrderDetails();
    }
}