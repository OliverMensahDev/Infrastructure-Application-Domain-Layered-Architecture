<?php

namespace App\Domain\Order;

use PHPUnit\Framework\TestCase;

final class OrderTest extends TestCase
{
  /**
   * @test
   */
  public function it_can_be_placed(): void
  {
    $orderId = $this->someOrderId();
    $quantity = $this->someQuantity();
    $amount = $this->someAmount();
    $emailAddress =  "olivermensah96@gmail.com";

    $order = Order::place($orderId, $emailAddress, $quantity, $amount);
    self::assertEquals(
      [new OrderWasPlaced(
        $orderId,
        $emailAddress
      )],
      $order->releaseEvents()
    );
  }


  private function someOrderId(): OrderId
  {
    return OrderId::fromString('eaa631d0-3760-43f5-a8cf-f239aadfe4aa');
  }

  private function someQuantity(): int
  {
    return 8;
  }

  private function someAmount(): int
  {
    return 12;
  }

  // private function someUserId()
  // {
  //     return UserId::fromString('bb235de9-c15d-4bd8-9bc3-d31e4cc0e96f');
  // }
}
