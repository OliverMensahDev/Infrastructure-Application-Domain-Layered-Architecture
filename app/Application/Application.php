<?php

namespace App\Application;

use App\Application\CreateEbook\CreateEbook;
use App\Application\CreateEbook\CreateEbookService;
use App\Application\CreateOrder\CreateOrder;
use App\Application\CreateOrder\CreateOrderService;
use App\Application\ListAvailableEbooks\Ebook;
use App\Application\ListAvailableEbooks\ListEBooksRepository;
use App\Application\ShowSingleEbook\GetEbookRepository;
use App\Domain\Ebook\EbookId;
use App\Domain\Order\OrderId;

final class Application implements ApplicationInterface
{
  private $ebookOrderService;
  private $listAvailableEbooksRepository;
  private $createEbookService;
  private $getEbookRepository;
  public function __construct(
    CreateOrderService $ebookOrderService,
    ListEBooksRepository $listAvailableEbooksRepository,
    CreateEbookService $createEbookService,
    GetEbookRepository $getEbookRepository
  ) {
    $this->ebookOrderService = $ebookOrderService;
    $this->listAvailableEbooksRepository = $listAvailableEbooksRepository;
    $this->createEbookService = $createEbookService;
    $this->getEbookRepository = $getEbookRepository;
  }
  public function createOrderService(CreateOrder $command): OrderId
  {
    return $this->ebookOrderService->create($command);
  }
  public function listAvailableEbooksRepository(): array
  {
    return $this->listAvailableEbooksRepository->listAvailableEbooks();
  }

  public function createEbookService(CreateEbook $command): EbookId
  {
    return $this->createEbookService->addEbookAction($command);
  }

  public function getEbookRepository(EbookId $ebookId): Ebook
  {
    return $this->getEbookRepository->getEbook($ebookId);
  }
}
