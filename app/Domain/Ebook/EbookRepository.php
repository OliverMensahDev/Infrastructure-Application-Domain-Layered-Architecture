<?php

namespace App\Domain\Ebook;

use App\Domain\Ebook\ReadModel\Ebook as ReadModelEbook;

interface EbookRepository
{
  public function save(Ebook $ebook);
  /**
   * @throws CouldNotFindEbook
   */
  public function getById(EbookId $ebookId): ReadModelEbook;

  public function identity(): EbookId;
}
