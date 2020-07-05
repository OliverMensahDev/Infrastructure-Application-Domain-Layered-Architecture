<?php

namespace App\Application\ListAvailableEbooks;


interface ListEBooksRepository
{
  /**
   * @return array<Ebook>
   */
  public function listAvailableEbooks(): array;
}
