<?php

namespace App\Domain\Order;

use Assert\Assertion;

final class OrderId
{
  private $id;
  private function __construct(string $id)
  {
    Assertion::uuid($id);
    $this->id = $id;
  }

  public static function fromString(string $orderId): self
  {
    return new self($orderId);
  }

  public function asString(): string
  {
    return $this->id;
  }
}
