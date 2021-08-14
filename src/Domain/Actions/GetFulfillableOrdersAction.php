<?php

namespace FulfillableOrders\Domain\Actions;

use FulfillableOrders\Domain\Dtos\SortInput;
use FulfillableOrders\Domain\Dtos\SortList;
use FulfillableOrders\Domain\Dtos\StockInput;
use FulfillableOrders\Domain\Dtos\StockList;
use FulfillableOrders\Domain\Enums\Direction;
use FulfillableOrders\Domain\Services\Collection\CollectionFactory;
use FulfillableOrders\Domain\Services\Collection\OrderCollection;
use FulfillableOrders\Domain\Services\Reader\ReadsFileFromPathInterface;

class GetFulfillableOrdersAction
{
    private ReadsFileFromPathInterface $reader;

    private CollectionFactory $collectionFactory;

    public function __construct(ReadsFileFromPathInterface $reader, CollectionFactory $collectionFactory)
    {
        $this->reader = $reader;
        $this->collectionFactory = $collectionFactory;
    }

    public function handle(string $filePath, array $stocks): array
    {
        $csvContent = $this->reader->readFile($filePath);

        /** @var \FulfillableOrders\Domain\Services\Collection\OrderCollection $collection */
        $collection = $this->collectionFactory->create($csvContent->toArray(), OrderCollection::class);

        $sort = (new SortList())->add(new SortInput('priority', Direction::DESC))
            ->add(new SortInput('created_at', Direction::ASC));

        $collection->sort($sort);

        $stockList = new StockList();
        array_walk($stocks, function ($quantity, $productId) use ($stockList) {
            $stockList->add(new StockInput($productId, $quantity));
        });

        $collection->filterByStock($stockList);

        return $collection->getItems();
    }
}