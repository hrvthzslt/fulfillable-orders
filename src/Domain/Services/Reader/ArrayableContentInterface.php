<?php

namespace FulfillableOrders\Domain\Services\Reader;

interface ArrayableContentInterface
{
    public function toArray(): array;
}