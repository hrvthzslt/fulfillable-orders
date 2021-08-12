<?php

namespace FulfillableOrders\Presenters;

interface RendersTableInterface
{
    public function render(array $items): void;
}