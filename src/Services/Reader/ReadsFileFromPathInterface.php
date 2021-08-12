<?php

namespace FulfillableOrders\Services\Reader;

interface ReadsFileFromPathInterface
{
    public function readFile(string $path): ArrayableContentInterface;
}