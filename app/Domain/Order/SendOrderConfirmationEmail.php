<?php

namespace App\Domain\Order;

interface SendOrderConfirmationEmail
{
  public function send(OrderId $orderId, string $emailAddress): void;
}
