<?php

namespace App\Domain\Order;

use App\Domain\Common\EventRecordingCapabilities;
use Assert\Assertion;

final class Order
{

  use EventRecordingCapabilities;

  private $emailAddress;
  private $quantityOrdered;
  private $orderAmount;
  /**
   * @var OrderId
   */
  private  $id;

  private function __construct(
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

  public static function place(
    OrderId $id,
    string $emailAddress,
    int $quantityOrdered,
    int $orderAmount
  ): self {
    $order = new self(
      $id,
      $emailAddress,
      $quantityOrdered,
      $orderAmount
    );

    $order->recordThat(new OrderWasPlaced($id, $quantityOrdered, $orderAmount));

    return $order;
  }

  public function orderId(): OrderId
  {
    return $this->orderId();
  }
}
