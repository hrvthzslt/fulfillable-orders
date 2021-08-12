<?php

namespace FulfillableOrders\Enums;

final class Direction
{
    public const ASC = 'asc';

    public const DESC = 'desc';

    public static function values(): array
    {
        return [self::ASC, self::DESC];
    }
}