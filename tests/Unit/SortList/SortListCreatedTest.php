<?php

namespace Tests\Unit\SortList;

use FulfillableOrders\Domain\Dtos\SortInput;
use FulfillableOrders\Domain\Dtos\SortList;
use FulfillableOrders\Domain\Enums\Direction;
use PHPUnit\Framework\TestCase;

class SortListCreatedTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param  string  $firstField
     * @param  string  $firstDirection
     * @param  string  $secondField
     * @param  string  $secondDirection
     */
    public function test(string $firstField, string $firstDirection, string $secondField, string $secondDirection)
    {
        $sortList = (new SortList())->add(new SortInput($firstField, $firstDirection))
            ->add(new SortInput($secondField, $secondDirection));

        $this->assertIsArray($sortList->getList());
        $this->assertCount(2, $sortList->getList());
    }

    public function dataProvider(): array
    {
        return [
            'Sort list with priority/desc and created_at/asc' => [
                'firstField'      => 'priority',
                'firstDirection'  => Direction::DESC,
                'secondField'     => 'created_at',
                'secondDirection' => Direction::ASC,
            ],
            'Sort list with name/asc and updated_at/desc'     => [
                'firstField'      => 'name',
                'firstDirection'  => Direction::ASC,
                'secondField'     => 'updated_at',
                'secondDirection' => Direction::DESC,
            ],
        ];
    }
}