<?php

namespace Tests\Unit\CsvContent;

use FulfillableOrders\Domain\Services\Reader\CsvContent;
use PHPUnit\Framework\TestCase;

class ArrayableContentCreatedTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param  array  $header
     * @param  array  $rows
     * @param  array  $expectedArray
     */
    public function test(array $header, array $rows, array $expectedArray)
    {
        $csvContent = new CsvContent($header, $rows);
        $this->assertEquals($csvContent->toArray(), $expectedArray);
    }

    public function dataProvider(): array
    {
        return [
            "Case #1" => [
                "header"        => ['id', 'title'],
                "rows"          => [
                    ['1', 'A title for test'],
                    ['2', 'Another'],
                ],
                "expectedArray" => [
                    ['id' => '1', 'title' => 'A title for test'],
                    ['id' => '2', 'title' => 'Another'],
                ],
            ],
            "Case #2" => [
                "header"        => ['x', 'y'],
                "rows"          => [
                    [12, 20],
                    [12, 30],
                ],
                "expectedArray" => [
                    ['x' => 12, 'y' => 20],
                    ['x' => 12, 'y' => 30],
                ],
            ],
        ];
    }
}