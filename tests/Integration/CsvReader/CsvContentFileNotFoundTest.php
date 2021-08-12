<?php

namespace Tests\Integration\CsvReader;

use FulfillableOrders\Exceptions\FileNotFoundAtPathException;
use FulfillableOrders\Services\Reader\CsvReader;
use PHPUnit\Framework\TestCase;

class CsvContentFileNotFoundTest extends TestCase
{
    public function test()
    {
        $this->expectException(FileNotFoundAtPathException::class);

        $csvReader = new CsvReader();
        $csvReader->readFile('nosuchfile.csv');
    }
}