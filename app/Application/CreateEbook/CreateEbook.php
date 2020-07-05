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
}
