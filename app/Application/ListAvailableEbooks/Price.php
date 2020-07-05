<?php

namespace App\Application\ListAvailableEbooks;

final class Price
{
  private $priceInCents;
  private function __construct(int $priceInCents)
  {
    $this->priceInCents = $priceInCents;
  }
  public static function fromInt(int $priceInCents): self
  {
    return new self($priceInCents);
  }
  public function asInt(): int
  {
    return $this->priceInCents;
  }

  public function asFormattedAmount(): string
  {
    return strval($this->priceInCents);
  }
}
