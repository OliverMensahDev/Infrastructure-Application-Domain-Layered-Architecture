<?php

namespace App\Application\CreateEbook;

final class CreateEbook
{
  private $name;
  private $price;
  public function __construct(string  $name, int $price)
  {
    $this->name = $name;
    $this->price = $price;
  }

  public function name(): string
  {
    return $this->name;
  }
  public function price(): int
  {
    return $this->price;
  }

  public static function fromRequestData(array $data): self
  {
    return new self(
      $data['name'],
      $data['price'],
    );
  }
}
