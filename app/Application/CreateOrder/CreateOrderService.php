<?php

namespace App\Application\CreateOrder;

use App\Application\Common\EventDispatcher;
use App\Application\Common\Events\SendOrderConfirmationEmailEventSubsriber;
use App\Domain\Ebook\EbookId;
use App\Domain\Ebook\EbookRepository;
use App\Domain\Order\Order;
use App\Domain\Order\OrderId;
use App\Domain\Order\OrderRepository;
use App\Domain\Order\OrderWasPlaced;
use App\Domain\Order\SendOrderConfirmationEmailWithPHPMailer;

final class CreateOrderService
{
  private $orderRepository;
  private $ebookRepository;

  public function __construct(
    OrderRepository $orderRepository,
    EbookRepository $ebookRepository
  ) {
    $this->orderRepository = $orderRepository;
    $this->ebookRepository = $ebookRepository;
  }

  public function create(CreateOrder $createOrder): OrderId
  {
    $ebook = $this->ebookRepository->getById(EbookId::fromString($createOrder->ebookId()));
    $orderAmount = (int) $createOrder->orderQuantity() * (int) $ebook->price();
    $orderId = $this->orderRepository->identity();
    $order = Order::place(
      $orderId,
      $createOrder->emailAddress(),
      $createOrder->orderQuantity(),
      $orderAmount
    );
    $this->orderRepository->save($order);
    // $this->sendOrderConfirmationEmail->send($orderId, $createOrder->emailAddress());
    $listener = new SendOrderConfirmationEmailEventSubsriber(new SendOrderConfirmationEmailWithPHPMailer);
    $dispatcher = new EventDispatcher(
      [
        OrderWasPlaced::class => [$listener, 'whenOrderWasCreated']
      ]
    );
    $dispatcher->dispatchAll($order->releaseEvents());
    return $orderId;
  }
}
