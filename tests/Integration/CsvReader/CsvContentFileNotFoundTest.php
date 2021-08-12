<?php

namespace Tests\Integration\CsvReader;

use FulfillableOrders\Domain\Exceptions\FileNotFoundAtPathException;
use FulfillableOrders\Domain\Services\Reader\CsvReader;
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