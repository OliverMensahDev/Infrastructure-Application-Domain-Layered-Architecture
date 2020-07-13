<?php

namespace App\Http\Controllers;

use App\Application\ApplicationInterface;
use App\Application\CreateOrder\CreateOrder;
use Illuminate\Http\Request;
use Throwable;

class OrderController
{

  private $application;

  public function __construct(ApplicationInterface $application)
  {
    $this->application = $application;
  }

  public function orderEbookAction(Request $request)
  {
    try {
      $validatedData = $request->validate([
        'quantity'     => 'integer|required',
        'email_address'      => 'email|required',
      ]);
      $data = array_merge(['id' => $request->route('id')], $validatedData);
      $orderId = $this->application->createOrderService(
        CreateOrder::fromRequestData($data)
      );
      return response()->json(["order_id" => $orderId->asString()]);
    } catch (Throwable $th) {
      abort(422, "Error - {$th->getMessage()}");
    }
  }
}
