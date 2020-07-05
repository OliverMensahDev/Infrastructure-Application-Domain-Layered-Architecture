<?php

namespace App\Application\CreateEbook;

use App\Domain\Ebook\Ebook;
use App\Domain\Ebook\EbookId;
use App\Domain\Ebook\EbookRepository;

final class CreateEbookService
{
  private $ebookRepository;
  public function __construct(EbookRepository $ebookRepository)
  {
    $this->ebookRepository = $ebookRepository;
  }
  public function addEbookAction(CreateEbook $createEbook): EbookId
  {
    $ebookId = $this->ebookRepository->identity();
    $ebook = new Ebook(
      $ebookId,
      $createEbook->name(),
      $createEbook->price()
    );
    $this->ebookRepository->save($ebook);
    return $ebookId;
  }
}
