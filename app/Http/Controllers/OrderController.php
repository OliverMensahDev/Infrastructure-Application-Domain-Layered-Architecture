<?php

namespace App\Http\Controllers;

use App\Application\CreateOrder\CreateOrder;
use App\Application\CreateOrder\CreateOrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController
{

  private $createOrderService;

  public function __construct(CreateOrderService $createOrderService)
  {
    $this->createOrderService = $createOrderService;
  }

  public function orderEbookAction(Request $request)
  {
    $orderId = $this->createOrderService->create(
      new CreateOrder(
        $request->ebook_id,
        $request->quantity,
        $request->email_address
      )
    );
    return response()->json(["order_id" => $orderId->asString()]);
  }
}
