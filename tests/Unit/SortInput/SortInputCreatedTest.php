<?php

namespace Tests\Unit\SortInput;

use FulfillableOrders\Domain\Dtos\SortInput;
use FulfillableOrders\Domain\Enums\Direction;
use PHPUnit\Framework\TestCase;

class SortInputCreatedTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param  string  $field
     * @param  string  $direction
     */
    public function test(string $field, string $direction)
    {
        $sortInput = new SortInput($field, $direction);

        $this->assertEquals($field, $sortInput->getField());
        $this->assertEquals($direction, $sortInput->getDirection());
    }

    public function dataProvider(): array
    {
        return [
            'Title ascending' => [
                'field' => 'title',
                'direction' => Direction::ASC,
            ],
            'Created at descending' => [
                'field' => 'created_at',
                'direction' => Direction::DESC,
            ],
        ];
    }
}