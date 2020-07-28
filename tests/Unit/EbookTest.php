<?php

namespace App\Domain\Ebook;

use PHPUnit\Framework\TestCase;

final class EbookTest extends TestCase
{
  /**
   * @test
   */
  public function it_can_be_placed(): void
  {
    $ebookId = $this->someEbookId();
    $title = $this->someTitle();
    $price = $this->somePrice();

    $ebook = Ebook::create($ebookId, $title, $price);
    self::assertEquals(
      [new EbookWasCreated(
        $ebookId,
        $title,
        $price
      )],
      $ebook->releaseEvents()
    );
  }


  private function someEbookId(): EbookId
  {
    return EbookId::fromString('eaa631d0-3760-43f5-a8cf-f239aadfe4aa');
  }

  private function someTitle(): string
  {
    return "Some Book Title";
  }

  private function somePrice(): int
  {
    return 12;
  }

  // private function someUserId()
  // {
  //     return UserId::fromString('bb235de9-c15d-4bd8-9bc3-d31e4cc0e96f');
  // }
}
