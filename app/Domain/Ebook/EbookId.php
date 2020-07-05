<?php

namespace App\Domain\Ebook;

use Assert\Assertion;
use Ramsey\Uuid\Rfc4122\UuidInterface;

final class EbookId
{
  private $id;
  private function __construct(string $id)
  {
    Assertion::uuid($id);
    $this->id = $id;
  }
  // public static function fromUuid(UuidInterface $id): self
  // {
  //   return new self($id);
  // }

  // public function asString(): string
  // {
  //   return $this->id->toString();
  // }

  public static function fromString(string $ebookId): self
  {
    return new self($ebookId);
  }
  public function asString(): string
  {
    return $this->id;
  }
}
