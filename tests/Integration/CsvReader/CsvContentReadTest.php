<?php

namespace Tests\Integration\CsvReader;

use FulfillableOrders\Services\Reader\CsvContent;
use FulfillableOrders\Services\Reader\CsvReader;
use PHPUnit\Framework\TestCase;

class CsvContentReadTest extends TestCase
{
    private string $testFileName = 'list.csv';

    public function setUp(): void
    {
        parent::setUp();

        $list = [
            ['1'],
            ['2'],
        ];

        $resource = fopen($this->testFileName, 'w');

        foreach ($list as $fields) {
            fputcsv($resource, $fields);
        }

        fclose($resource);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        unlink($this->testFileName);
    }

    public function test(): void
    {
        $csvReader = new CsvReader();
        $csvContent = $csvReader->readFile($this->testFileName);
        $this->assertInstanceOf(CsvContent::class, $csvContent);
    }
}