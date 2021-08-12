<?php

namespace FulfillableOrders\Domain\Services\Reader;

class CsvContent implements ArrayableContentInterface
{
    private array $header;

    private array $rows;

    public function __construct(array $header, array $rows)
    {
        $this->header = $header;
        $this->rows = $rows;
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this->rows as $row) {
            $array[] = array_combine($this->header, $row);
        }

        return $array;
    }
}