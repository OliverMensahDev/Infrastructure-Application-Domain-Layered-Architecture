<?php

namespace App\Application;

use App\Application\CreateEbook\CreateEbook;
use App\Application\CreateOrder\CreateOrder;
use App\Application\ListAvailableEbooks\Ebook;
use App\Domain\Ebook\EbookId;
use App\Domain\Order\OrderId;

interface ApplicationInterface
{
  public function createOrderService(CreateOrder $command): OrderId;

  public function createEbookService(CreateEbook $command): EbookId;


  /**
   * @return array<Ebook>
   */
  public function listAvailableEbooksRepository(): array;
  public function getEbookRepository(EbookId $ebookId): Ebook;
}
