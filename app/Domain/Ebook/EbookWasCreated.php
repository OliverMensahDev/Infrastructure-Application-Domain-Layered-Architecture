<?php

declare(strict_types=1);

namespace App\Domain\Ebook;


final class EbookWasCreated
{
  /**
   * @var EbookId
   */
  private $ebookId;
  private $price;
  private $name;

  public function __construct(
    EbookId $ebookId,
    string $name,
    int $price
  ) {
    $this->ebookId = $ebookId;
    $this->name = $name;
    $this->price = $price;
  }

  public function ebookId(): EbookId
  {
    return $this->ebookId;
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
