<?php

namespace App\Repositories;

use App\Domain\Order\Order;
use App\Domain\Order\OrderId;
use App\Domain\Order\OrderRepository;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class SQLOrderRepository implements OrderRepository
{
  public function save(Order $order)
  {
    DB::table('orders')->insertGetId($order->mappedData());
  }

  public function getById(string $orderId): Order
  {
    $order = DB::table('orders')->where('uuid',  $orderId)->first();
    return new Order(
      $order->uuid,
      $order->email,
      $order->quantity,
      $order->amount,
    );
  }

  public function identity(): OrderId
  {
    return OrderId::fromUuid(
      Uuid::uuid4()
    );
  }
}
