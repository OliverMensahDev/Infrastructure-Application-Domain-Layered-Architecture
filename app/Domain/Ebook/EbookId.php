<?php

namespace App\Domain\Ebook;

use Assert\Assertion;

final class EbookId
{
  private $id;
  private function __construct(string $id)
  {
    Assertion::uuid($id);
    $this->id = $id;
  }

  public static function fromString(string $ebookId): self
  {
    return new self($ebookId);
  }
  public function asString(): string
  {
    return $this->id;
  }
}
