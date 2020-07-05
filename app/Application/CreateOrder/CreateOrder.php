<?php

namespace App\Application\CreateOrder;


final class CreateOrder
{
  private $ebookId;
  private $orderQuantity;
  private $emailAddress;
  public function __construct(string  $ebookId, int $quantity,  string $email_address)
  {
    $this->ebookId = $ebookId;
    $this->orderQuantity = $quantity;
    $this->emailAddress = $email_address;
  }
  public function ebookId(): string
  {
    return $this->ebookId;
  }
  public function orderQuantity(): int
  {
    return $this->orderQuantity;
  }
  public function emailAddress(): string
  {
    return $this->emailAddress;
  }
}
