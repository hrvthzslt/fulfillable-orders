<?php

namespace FulfillableOrders\Domain\Presenters;

use FulfillableOrders\Domain\Dtos\RenderableRowList;

interface RendersTableInterface
{
    public function render(RenderableRowList $renderableRowList): void;
}