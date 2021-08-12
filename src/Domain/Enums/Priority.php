<?php

namespace FulfillableOrders\Domain\Enums;

class Priority
{
    public const LOW = 'low';

    public const MEDIUM = 'medium';

    public const HIGH = 'high';

    public static function list(): array
    {
        return [1 => self::LOW, 2 => self::MEDIUM, 3 => self::HIGH];
    }
}