<?php

namespace FulfillableOrders\Domain\Actions;

use FulfillableOrders\Domain\Enums\Direction;
use FulfillableOrders\Domain\Services\Collection\CollectionFactory;
use FulfillableOrders\Domain\Services\Collection\OrderCollection;
use FulfillableOrders\Domain\Services\Reader\ReadsFileFromPathInterface;
use FulfillableOrders\Domain\Values\SortBag;
use FulfillableOrders\Domain\Values\StockBag;

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

        /** @var \FulfillableOrders\Domain\Services\Collection\OrderCollection $collection */
        $collection = $this->collectionFactory->create($csvContent->toArray(), OrderCollection::class);

        $sort = (new SortBag())->add('priority', Direction::DESC)->add('created_at', Direction::ASC);

        $collection->sort($sort);

        $stock = (new StockBag())->addMultiple($stock);

        $collection->filterByStock($stock);

        return $collection->getItems();
    }
}