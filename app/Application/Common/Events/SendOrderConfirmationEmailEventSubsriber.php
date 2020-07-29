<?php

namespace App\Application\Common\Events;

use App\Domain\Order\OrderWasPlaced;
use App\Domain\Order\SendOrderConfirmationEmail;

final class SendOrderConfirmationEmailEventSubsriber
{
  private $sendOrderConfirmationEmail;

  public function __construct(SendOrderConfirmationEmail $sendOrderConfirmationEmail)
  {
    $this->sendOrderConfirmationEmail = $sendOrderConfirmationEmail;
  }

  public function whenOrderWasCreated(OrderWasPlaced $event): void
  {
    $this->sendOrderConfirmationEmail->send($event->orderId(), $event->emailAddress());
  }
}
