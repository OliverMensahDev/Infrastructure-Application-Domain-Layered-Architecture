<?php

namespace App\Domain\Ebook;

use App\Domain\Common\EventRecordingCapabilities;
use Assert\Assertion;

final class Ebook
{
  use EventRecordingCapabilities;

  private $id;
  private $name;
  private $discount;
  private $price;
  private function __construct(EbookId $id, string $name, int $price)
  {
    Assertion::greaterThan($price, 0);
    Assertion::string($name);
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


  public static function create(
    EbookId $id,
    string $name,
    int $price
  ): self {
    $ebook = new self(
      $id,
      $name,
      $price
    );

    $ebook->recordThat(new EbookWasCreated($id, $name, $price));

    return $ebook;
  }

  public function ebookId(): EbookId
  {
    return $this->ebookId;
  }
}
