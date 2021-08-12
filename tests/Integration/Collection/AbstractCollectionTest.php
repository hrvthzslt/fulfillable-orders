<?php

namespace Tests\Integration\Collection;

use PHPUnit\Framework\TestCase;

abstract class AbstractCollectionTest extends TestCase
{
    protected $itemsToCollect
        = [
            ['quantity' => '1', 'letter' => 'A'],
            ['quantity' => '1', 'letter' => 'B'],
            ['quantity' => '1', 'letter' => 'C'],
            ['quantity' => '2', 'letter' => 'D'],
            ['quantity' => '3', 'letter' => 'E'],
            ['quantity' => '3', 'letter' => 'F'],
        ];

    abstract public function test();
}