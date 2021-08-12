<?php

namespace Tests\Unit\CsvContent;

use FulfillableOrders\Domain\Services\Reader\CsvContent;
use PHPUnit\Framework\TestCase;

class ArrayableContentCreatedTest extends TestCase
{
    public function test()
    {
        $header = ['id', 'title'];
        $rows = [
            ['1', 'A title for test'],
            ['2', 'Another'],
        ];

        $csvContent = new CsvContent($header, $rows);

        $expectedArray = [
            ['id' => '1', 'title' => 'A title for test'],
            ['id' => '2', 'title' => 'Another'],
        ];

        $this->assertEquals($csvContent->toArray(), $expectedArray);
    }
}