<?php

namespace App\Http\Controllers;

use App\Application\Application;
use App\Application\CreateEbook\CreateEbook;
use App\Application\CreateEbook\CreateEbookService;
use App\Application\ListAvailableEbooks\ListEBooksRepository;
use App\Application\ShowSingleEbook\GetEbookRepository;
use App\Domain\Ebook\EbookId;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class EbookController
{

  private $application;

  public function __construct(Application $application)
  {
    $this->application = $application;
  }

  public function addEbookAction(Request $request)
  {
    try {
      $request->validate([
        'name'     => 'string|required|min:3',
        'price'      => 'numeric|required',
      ]);
      $ebookId = $this->application->createEbookService(
        CreateEbook::fromRequestData($request->all())
      );
      return response()->json(["ebook_id" => $ebookId->asString()]);
    } catch (Throwable $th) {
      abort(422, "Error - {$th->getMessage()}");
    }
  }

  public function getEbookAction(Request $request)
  {
    $ebook = $this->application->getEbookRepository(EbookId::fromString($request->id));
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
    foreach ($this->application->listAvailableEbooksRepository() as $ebook) {
      $data[] = [
        'ebookId' => $ebook->ebookId(),
        'title' => $ebook->title(),
        'price' => $ebook->price()

      ];
    }
    return response()->json($data);
  }
}
