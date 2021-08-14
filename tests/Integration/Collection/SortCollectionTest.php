<?php

namespace Tests\Integration\Collection;

use FulfillableOrders\Domain\Dtos\SortInput;
use FulfillableOrders\Domain\Dtos\SortList;
use FulfillableOrders\Domain\Enums\Direction;
use FulfillableOrders\Domain\Services\Collection\Collection;
use PHPUnit\Framework\TestCase;

class SortCollectionTest extends TestCase
{
    /**
     * @dataProvider sortCollectionDataProvider
     *
     * @param  array   $itemsToCollect
     * @param  array   $expectedItems
     * @param  string  $firstField
     * @param  string  $firstDirection
     * @param  string  $secondField
     * @param  string  $secondDirection
     */
    public function test(
        array $itemsToCollect,
        array $expectedItems,
        string $firstField,
        string $firstDirection,
        string $secondField,
        string $secondDirection
    ) {
        $collection = new Collection($itemsToCollect);

        $collection->sort((new SortList())->add(new SortInput($firstField, $firstDirection))
            ->add(new SortInput($secondField, $secondDirection)));

        $this->assertEquals($expectedItems, $collection->getItems());
    }

    public function sortCollectionDataProvider(): array
    {
        return [
            'Letters with quantity' => [
                'itemsToCollect'  => [
                    ['quantity' => '1', 'letter' => 'A'],
                    ['quantity' => '1', 'letter' => 'B'],
                    ['quantity' => '1', 'letter' => 'C'],
                    ['quantity' => '2', 'letter' => 'D'],
                    ['quantity' => '3', 'letter' => 'E'],
                    ['quantity' => '3', 'letter' => 'F'],
                ],
                'expectedItems'   => [
                    ['quantity' => '3', 'letter' => 'E'],
                    ['quantity' => '3', 'letter' => 'F'],
                    ['quantity' => '2', 'letter' => 'D'],
                    ['quantity' => '1', 'letter' => 'A'],
                    ['quantity' => '1', 'letter' => 'B'],
                    ['quantity' => '1', 'letter' => 'C'],
                ],
                'firstField'      => 'quantity',
                'firstDirection'  => Direction::DESC,
                'secondField'     => 'letter',
                'secondDirection' => Direction::ASC,
            ],
            'Name and year'         => [
                'itemsToCollect'  => [
                    ['name' => 'Kyle', 'year' => '1988'],
                    ['name' => 'Kyle', 'year' => '1993'],
                    ['name' => 'Carol', 'year' => '2001'],
                ],
                'expectedItems'   => [
                    ['name' => 'Carol', 'year' => '2001'],
                    ['name' => 'Kyle', 'year' => '1993'],
                    ['name' => 'Kyle', 'year' => '1988'],
                ],
                'firstField'      => 'name',
                'firstDirection'  => Direction::ASC,
                'secondField'     => 'year',
                'secondDirection' => Direction::DESC,
            ],
        ];
    }
}