<?php

declare(strict_types=1);

namespace App\Domain\Order;


final class OrderWasPlaced
{
    /**
     * @var OrderId
     */
    private $orderId;
    private $quantityOrdered;
    private $orderAmount;

    public function __construct(
        OrderId $orderId,
        int $quantityOrdered,
        int $orderAmount
    ) {
        $this->orderId = $orderId;
        $this->quantityOrdered = $quantityOrdered;
        $this->orderAmount = $orderAmount;
    }

    public function orderId(): OrderId
    {
        return $this->orderId;
    }

    public function quantityOrdered(): int
    {
        return $this->quantityOrdered;
    }

    public function orderAmount(): int
    {
        return $this->orderAmount;
    }
}
