<?php

namespace FulfillableOrders\Presenters;

use FulfillableOrders\Enums\Priority;

class OrderTablePresenter extends AbstractTablePresenter implements RendersTableInterface
{
    protected function getMask(): string
    {
        return "%-20.20s%-20.20s%-20.20s%-20.20s\n";
    }

    protected function getHeader(): array
    {
        return ['product_id', 'quantity', 'priority', 'created_at'];
    }

    protected function getSeparator(): array
    {
        return ['====================', '====================', '====================', '===================='];
    }

    public function render(array $items): void
    {
        $header = $this->getHeader();
        $separator = $this->getSeparator();
        $mask = $this->getMask();
        printf($mask, $header[0], $header[1], $header[2], $header[3]);
        printf($mask, $separator[0], $separator[1], $separator[2], $separator[3]);

        foreach ($items as $item) {
            $item['priority'] = Priority::list()[$item['priority']];
            $values = array_values($item);
            printf($mask, $values[0], $values[1], $values[2], $values[3]);
        }
    }
}