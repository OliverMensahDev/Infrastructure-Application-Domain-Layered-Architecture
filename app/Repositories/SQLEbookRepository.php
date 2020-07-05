<?php

namespace App\Repositories;

use App\Domain\Ebook\Ebook;
use App\Domain\Ebook\EbookId;
use App\Domain\Ebook\EbookRepository;
use App\Domain\Ebook\ReadModel\Ebook as ReadModelEbook;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class SQLEbookRepository implements EbookRepository
{
  //using write model
  public function save(Ebook $ebook)
  {
    DB::table('ebooks')->insert($ebook->mappedData());
  }

  public function identity(): EbookId
  {
    return EbookId::fromString(
      Uuid::uuid4()->toString()
    );
  }

  //using Read Model for internal use
  public function getById(EbookId $ebookId): ReadModelEbook
  {
    $ebook = DB::table('ebooks')->where('uuid',  $ebookId->asString())->first();
    return new ReadModelEbook(
      $ebookId,
      $ebook->price
    );
  }
}
