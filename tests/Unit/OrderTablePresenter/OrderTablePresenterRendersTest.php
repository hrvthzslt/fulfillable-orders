<?php

namespace Tests\Unit\OrderTablePresenter;

use FulfillableOrders\Domain\Dtos\OrderTableRow;
use FulfillableOrders\Domain\Dtos\OrderTableRowList;
use FulfillableOrders\Domain\Presenters\OrderTablePresenter;
use PHPUnit\Framework\TestCase;

class OrderTablePresenterRendersTest extends TestCase
{
    private OrderTablePresenter $orderTablePresenter;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderTablePresenter = new OrderTablePresenter();
    }

    /**
     * @dataProvider dataProvider
     *
     * @param  array  $firstRowInput
     * @param  array  $secondRowInput
     * @param  array  $outputLines
     */
    public function test(array $firstRowInput, array $secondRowInput, array $outputLines)
    {
        foreach ($outputLines as $line) {
            $this->expectOutputRegex($line);
        }

        $orderTableRowList = (new OrderTableRowList())
            ->add(new OrderTableRow(
                $firstRowInput['product_id'],
                $firstRowInput['quantity'],
                $firstRowInput['priority'],
                $firstRowInput['created_at']
            ))->add(new OrderTableRow(
                $secondRowInput['product_id'],
                $secondRowInput['quantity'],
                $secondRowInput['priority'],
                $secondRowInput['created_at']
            ));

        $this->orderTablePresenter->render($orderTableRowList);
    }

    public function dataProvider(): array
    {
        return [
            "Render data set #1" => [
                'firstRowInput'  => [
                    'product_id' => 1,
                    'quantity'   => 2,
                    'priority'   => 3,
                    'created_at' => '1994-02-13 10:01:23',
                ],
                'secondRowInput' => [
                    'product_id' => 2,
                    'quantity'   => 1,
                    'priority'   => 2,
                    'created_at' => '1994-02-13 10:01:23',
                ],
                'outputLines'    => [
                    "/product_id          quantity            priority            created_at          /",
                    "/================================================================================/",
                    "/1                   2                   high                1994-02-13 10:01:23 /",
                    "/2                   1                   medium              1994-02-13 10:01:23 /",
                ],
            ],
            "Render data set #2" => [
                'firstRowInput'  => [
                    'product_id' => 34,
                    'quantity'   => 34,
                    'priority'   => 2,
                    'created_at' => '2009-02-14 01:01:23',
                ],
                'secondRowInput' => [
                    'product_id' => 34,
                    'quantity'   => 3,
                    'priority'   => 1,
                    'created_at' => '2009-02-13 01:01:23',
                ],
                'outputLines'    => [
                    "/product_id          quantity            priority            created_at          /",
                    "/================================================================================/",
                    "/34                  34                  medium              2009-02-14 01:01:23 /",
                    "/34                  3                   low                 2009-02-13 01:01:23 /",
                ],
            ],
        ];
    }
}