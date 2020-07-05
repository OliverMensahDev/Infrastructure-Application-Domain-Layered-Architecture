<?php

namespace App\Domain\Order;

use Ramsey\Uuid\Rfc4122\UuidInterface;

final class OrderId
{
  private $id;
  private function __construct(UuidInterface $id)
  {
    $this->id = $id;
  }
  public static function fromUuid(UuidInterface $id): self
  {
    return new self($id);
  }

  public function asString(): string
  {
    return $this->id->toString();
  }
}
