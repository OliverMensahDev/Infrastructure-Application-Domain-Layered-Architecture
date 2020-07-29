<?php

namespace App\Domain\Order;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class SendOrderConfirmationEmailWithPHPMailer implements SendOrderConfirmationEmail
{
  public function send(OrderId $orderId, string $emailAddress): void
  {
    $email = new  PHPMailer(true);
    try {
      $email->isSMTP();
      $email->Host       = 'smtp.zoho.com';
      $email->SMTPAuth   = true;
      $email->Username   = env('SMTP_USERNAME');
      $email->Password   = env('SMTP_PASSWORD');
      $email->SMTPSecure = "tls";
      $email->Port       = 587;
      $email->setFrom(env('SMTP_USERNAME'), 'Admin');
      $email->addAddress($emailAddress);
      $email->addReplyTo(env('SMTP_USERNAME'));
      $email->isHTML(true);
      $email->Subject = "Ordered Item";
      $sb = "### ORDERED ITEM DETAILS ####";
      $sb .= PHP_EOL;
      $sb .= PHP_EOL;
      $sb .= "OrderID: " .  $orderId->asString();
      $sb .= PHP_EOL;
      $email->Body = $sb;
      $email->send();
    } catch (Exception $e) {
      die("Message could not be sent. Error: {$email->ErrorInfo}");
    }
  }
}
