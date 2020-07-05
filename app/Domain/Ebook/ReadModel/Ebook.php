<?php

namespace App\Domain\Ebook\ReadModel;

use App\Domain\Ebook\EbookId;

final class Ebook
{
  private $id;
  private $price;
  public function __construct(EbookId $id, int $price)
  {
    $this->id = $id;
    $this->price = $price;
  }

  public function price()
  {
    return $this->price;
  }
}
