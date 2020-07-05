<?php

namespace App\Application\ShowSingleEbook;

use App\Application\ListAvailableEbooks\Ebook;
use App\Domain\Ebook\EbookId;

interface GetEbookRepository
{
  public function getEbook(EbookId $ebookId): Ebook;
}
