<?php

namespace App\Http\Controllers;

use App\Application\CreateEbook\CreateEbook;
use App\Application\CreateEbook\CreateEbookService;
use App\Application\ListAvailableEbooks\ListEBooksRepository;
use App\Application\ShowSingleEbook\GetEbookRepository;
use App\Domain\Ebook\EbookId;
use Illuminate\Http\Request;

class EbookController
{

  private $createEbookService;
  private $listEBooksRepository;
  private $getEbookRepository;

  public function __construct(
    CreateEbookService $createEbookService,
    ListEBooksRepository $listEBooksRepository,
    GetEbookRepository $getEbookRepository
  ) {
    $this->createEbookService = $createEbookService;
    $this->listEBooksRepository = $listEBooksRepository;
    $this->getEbookRepository = $getEbookRepository;
  }

  public function addEbookAction(Request $request)
  {
    $ebookId = $this->createEbookService->addEbookAction(
      new CreateEbook(
        $request->name,
        $request->price
      )
    );
    return response()->json(["ebook_id" => $ebookId->asString()]);
  }

  public function getEbookAction(Request $request)
  {
    $ebook = $this->getEbookRepository->getEbook(EbookId::fromString($request->id));
    $data =  [
      'id' => $ebook->ebookId(),
      'title' => $ebook->title(),
      'price' => $ebook->price()
    ];
    return response()->json($data);
  }

  public function listEbooks()
  {
    $data = [];
    foreach ($this->listEBooksRepository->listAvailableEbooks() as $ebook) {
      $data[] = [
        'ebookId' => $ebook->ebookId(),
        'title' => $ebook->title(),
        'price' => $ebook->price()

      ];
    }
    return response()->json($data);
  }
}
