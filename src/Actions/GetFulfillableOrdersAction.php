<?php

namespace FulfillableOrders\Actions;

use FulfillableOrders\Enums\Direction;
use FulfillableOrders\Services\Collection\CollectionFactory;
use FulfillableOrders\Services\Collection\OrderCollection;
use FulfillableOrders\Services\Reader\ReadsFileFromPathInterface;
use FulfillableOrders\Values\SortBag;
use FulfillableOrders\Values\StockBag;

class GetFulfillableOrdersAction
{
    private ReadsFileFromPathInterface $reader;

    private CollectionFactory $collectionFactory;

    public function __construct(ReadsFileFromPathInterface $reader, CollectionFactory $collectionFactory)
    {
        $this->reader = $reader;
        $this->collectionFactory = $collectionFactory;
    }

    public function handle(string $filePath, array $stock): array
    {
        $csvContent = $this->reader->readFile($filePath);

        /** @var \FulfillableOrders\Services\Collection\OrderCollection $collection */
        $collection = $this->collectionFactory->create($csvContent->toArray(), OrderCollection::class);

        $sort = (new SortBag())->add('priority', Direction::DESC)->add('created_at', Direction::DESC);

        $collection->sort($sort);

        $stock = (new StockBag())->addMultiple($stock);

        $collection->filterByStock($stock);

        return $collection->getItems();
    }
}