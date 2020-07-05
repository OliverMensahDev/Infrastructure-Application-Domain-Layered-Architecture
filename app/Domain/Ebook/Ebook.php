<?php

namespace App\Domain\Ebook;

use Assert\Assertion;

final class Ebook
{
  private $id;
  private $name;
  private $discount;
  private $price;
  public function __construct(EbookId $id, string $name, int $price)
  {
    Assertion::greaterThan($price, 0);
    $this->name = $name;
    $this->price = $price;
    $this->id = $id;
    $this->discount = 0;
  }

  public function mappedData()
  {
    return [
      'uuid' => $this->id->asString(),
      'name' => $this->name,
      'price' => $this->price,
      'discount' => $this->discount,
    ];
  }

  public function addDiscount(int $discount)
  {
    $this->discount = $discount;
  }
}
