<?php

namespace FulfillableOrders\Domain\Services\Reader;

interface ReadsFileFromPathInterface
{
    public function readFile(string $path): ArrayableContentInterface;
}