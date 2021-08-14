<?php

namespace Tests\Unit\StockList;

use FulfillableOrders\Domain\Dtos\StockInput;
use FulfillableOrders\Domain\Dtos\StockList;
use PHPUnit\Framework\TestCase;

class StockListCreatedTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param  int  $firstProductId
     * @param  int  $firstQuantity
     * @param  int  $secondProductId
     * @param  int  $secondQuantity
     */
    public function test(int $firstProductId, int $firstQuantity, int $secondProductId, int $secondQuantity)
    {
        $stockList = (new StockList())->add(new StockInput($firstProductId, $firstQuantity))
            ->add(new StockInput($secondProductId, $secondQuantity));

        $this->assertIsArray($stockList->getList());
        $this->assertCount(2, $stockList->getList());
    }

    public function dataProvider(): array
    {
        return [
            'Stock list #1' => [
                'firstProductId' => 1,
                'firstQuantity' => 2,
                'secondProductId' => 3,
                'secondQuantity' => 4,
            ],
            'Stock list #2' => [
                'firstProductId' => 7,
                'firstQuantity' => 32,
                'secondProductId' => 88,
                'secondQuantity' => 1,
            ],
        ];
    }
}