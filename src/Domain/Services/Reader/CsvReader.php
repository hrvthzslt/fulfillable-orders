<?php

namespace FulfillableOrders\Domain\Services\Reader;

use FulfillableOrders\Domain\Exceptions\FileNotFoundAtPathException;

class CsvReader implements ReadsFileFromPathInterface
{
    private string $delimiter = ',';

    public function __construct(?string $delimiter = ',')
    {
        $this->delimiter = $delimiter;
    }

    public function readFile(string $path): ArrayableContentInterface
    {
        try {
            $lines = file($path);
        } catch (\Exception $e) {
            throw new FileNotFoundAtPathException("File not found at path: {$path}");
        }

        $rows = array_map(function ($row) use ($lines) {
            return str_getcsv($row, $this->delimiter);
        }, $lines);

        $header = array_shift($rows);

        return new CsvContent($header, $rows);
    }
}