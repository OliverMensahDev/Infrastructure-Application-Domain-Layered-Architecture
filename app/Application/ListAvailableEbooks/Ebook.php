<?php

namespace App\Application\ListAvailableEbooks;

use App\Domain\Ebook\EbookId;

final class Ebook
{
  private $id;
  private $name;
  private $price;
  public function __construct(EbookId $id, string $name, int $price)
  {
    $this->name = $name;
    $this->price = $price;
    $this->id = $id;
  }
  public function ebookId(): string
  {
    return $this->id->asString();
  }
  public function title(): string
  {
    return $this->name;
  }
  public function price(): string
  {
    return Price::fromInt($this->price)->asFormattedAmount();
  }
}
