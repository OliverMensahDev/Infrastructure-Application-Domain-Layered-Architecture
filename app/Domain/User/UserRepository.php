<?php

namespace App\Domain\User;

interface UserRepository
{
  public function save(User $order);
  /**
   * @throws CouldNotFindOrder
   */
  public function getById(string $orderId): User;

  public function identity(): OrderId;
}
