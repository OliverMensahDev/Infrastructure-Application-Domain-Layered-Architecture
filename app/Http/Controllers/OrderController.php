<?php

namespace App\Http\Controllers;

use App\Application\CreateOrder\CreateOrder;
use App\Application\CreateOrder\CreateOrderService;
use Illuminate\Http\Request;

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
        $request->route('id'),
        $request->quantity,
        $request->email_address
      )
    );
    return response()->json(["order_id" => $orderId->asString()]);
  }
}