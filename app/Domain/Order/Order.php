<?php

namespace App\Domain\Order;

use Assert\Assertion;

final class Order
{
  private $emailAddress;
  private $quantityOrdered;
  private $orderAmount;
  private  $id;
  public function __construct(
    OrderId $id,
    string $emailAddress,
    int $quantityOrdered,
    int $orderAmount
  ) {
    Assertion::email($emailAddress);
    Assertion::greaterThan($quantityOrdered, 0);
    Assertion::greaterThan($orderAmount, 0);
    $this->emailAddress = $emailAddress;
    $this->quantityOrdered = $quantityOrdered;
    $this->orderAmount = $orderAmount;
    $this->id = $id;
  }

  public function mappedData()
  {
    return [
      'uuid' => $this->id->asString(),
      'email' => $this->emailAddress,
      'quantity' => $this->quantityOrdered,
      'amount' => $this->orderAmount,
    ];
  }
}
