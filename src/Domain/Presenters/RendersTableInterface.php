<?php

namespace FulfillableOrders\Domain\Presenters;

interface RendersTableInterface
{
    public function render(array $items): void;
}