<?php

namespace App\Repositories;

use App\Application\ListAvailableEbooks\Ebook;
use App\Application\ListAvailableEbooks\ListEBooksRepository;
use App\Application\ShowSingleEbook\GetEbookRepository;
use App\Domain\Ebook\EbookId;
use Illuminate\Support\Facades\DB;

class EbooksUsingSQL implements ListEBooksRepository, GetEbookRepository
{
  public function listAvailableEbooks(): array
  {
    $ebooks = DB::table('ebooks')->get();
    return array_map(
      function ($ebook) {
        return new Ebook(
          EbookId::fromString($ebook->uuid),
          $ebook->name,
          $ebook->price
        );
      },
      $ebooks->toArray()
    );
    return ['ebooks' => $ebooks];
  }

  public function getEbook(EbookId $ebookId): Ebook
  {
    $ebook = DB::table('ebooks')->where('uuid',  $ebookId->asString())->first();
    return new Ebook(
      $ebookId,
      $ebook->name,
      $ebook->price
    );
  }
}
