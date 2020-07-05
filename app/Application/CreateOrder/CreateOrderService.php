<?php

namespace App\Application\CreateOrder;

use App\Domain\Ebook\EbookId;
use App\Domain\Ebook\EbookRepository;
use App\Domain\Order\Order;
use App\Domain\Order\OrderId;
use App\Domain\Order\OrderRepository;

final class CreateOrderService
{
  private $orderRepository;
  private $ebookRepository;

  public function __construct(OrderRepository $orderRepository, EbookRepository $ebookRepository)
  {
    $this->orderRepository = $orderRepository;
    $this->ebookRepository = $ebookRepository;
  }

  public function create(CreateOrder $createOrder): OrderId
  {
    $ebook = $this->ebookRepository->getById(EbookId::fromString($createOrder->ebookId()));
    $orderAmount = (int) $createOrder->orderQuantity() * (int) $ebook->price();
    $orderId = $this->orderRepository->identity();
    $order = new Order(
      $orderId,
      $createOrder->emailAddress(),
      $createOrder->orderQuantity(),
      $orderAmount
    );
    $this->orderRepository->save($order);
    return $orderId;
  }
}
