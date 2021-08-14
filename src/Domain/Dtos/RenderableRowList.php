<?php

namespace FulfillableOrders\Domain\Dtos;

interface RenderableRowList
{
    public function getList(): array;
}