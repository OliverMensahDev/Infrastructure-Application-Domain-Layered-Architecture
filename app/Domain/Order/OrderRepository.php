<?php

namespace App\Domain\Order;

interface OrderRepository
{
  public function save(Order $order);
  /**
   * @throws CouldNotFindOrder
   */
  public function getById(OrderId $orderId): Order;

  public function identity(): OrderId;
}
