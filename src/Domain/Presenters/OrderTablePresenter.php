<?php

namespace FulfillableOrders\Domain\Presenters;

use FulfillableOrders\Domain\Dtos\RenderableRowList;

class OrderTablePresenter extends AbstractTablePresenter implements RendersTableInterface
{
    public function render(RenderableRowList $renderableRowList): void
    {
        $header = $this->getHeader();
        $separator = $this->getSeparator();
        $mask = $this->getMask();
        printf($mask, $header[0], $header[1], $header[2], $header[3]);
        printf($mask, $separator[0], $separator[1], $separator[2], $separator[3]);

        foreach ($renderableRowList->getList() as $row) {
            printf($mask, $row->getProductId(), $row->getQuantity(), $row->getPriority(), $row->getCreatedAt());
        }
    }

    protected function getHeader(): array
    {
        return ['product_id', 'quantity', 'priority', 'created_at'];
    }

    protected function getSeparator(): array
    {
        return ['====================', '====================', '====================', '===================='];
    }

    protected function getMask(): string
    {
        return "%-20.20s%-20.20s%-20.20s%-20.20s\n";
    }
}