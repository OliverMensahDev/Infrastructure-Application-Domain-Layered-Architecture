<?php

declare(strict_types=1);

namespace App\Domain\Order;


final class OrderWasPlaced
{
    /**
     * @var OrderId
     */
    private $orderId;
    private $emailAddress;

    public function __construct(
        OrderId $orderId,
        string $emailAddress
    ) {
        $this->orderId = $orderId;
        $this->emailAddress = $emailAddress;
    }

    public function orderId(): OrderId
    {
        return $this->orderId;
    }

    public function emailAddress(): string
    {
        return $this->emailAddress;
    }
}
