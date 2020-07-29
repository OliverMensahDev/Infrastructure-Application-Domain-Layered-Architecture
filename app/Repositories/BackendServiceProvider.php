<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{

  public function register()
  {
    $this->app->bind(
      'App\Domain\Order\OrderRepository',
      'App\Repositories\SQLOrderRepository'
    );
    $this->app->bind(
      'App\Domain\Ebook\EbookRepository',
      'App\Repositories\SQLEbookRepository'
    );
    $this->app->bind(
      'App\Application\ListAvailableEbooks\ListEBooksRepository',
      'App\Repositories\EbooksUsingSQL'
    );
    $this->app->bind(
      'App\Application\ShowSingleEbook\GetEbookRepository',
      'App\Repositories\EbooksUsingSQL'
    );
    $this->app->bind(
      'App\Application\ApplicationInterface',
      'App\Application\Application',
    );
    $this->app->bind(
      'App\Domain\Order\SendOrderConfirmationEmail',
      'App\Domain\Order\SendOrderConfirmationEmailWithPHPMailer',
    );
  }
}
