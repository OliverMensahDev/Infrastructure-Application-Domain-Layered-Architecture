<?php

declare(strict_types=1);

namespace App\Application\Common;

use Assert\Assertion;

final class EventDispatcher
{
  private  $listeners;
  public function __construct(array $listenersByType)
  {
    foreach ($listenersByType as $eventType => $listeners) {
      Assertion::string($eventType);
      Assertion::isObject($listeners[0]);
    }
    $this->listeners = $listenersByType;
  }
  public function dispatch(object $event): void
  {
    $listener = $this->listeners[get_class($event)];
    // dd($listener[0], $listener[1], $event);
    call_user_func_array([$listener[0], $listener[1]], [$event]);

    // $listener[0]->$listener[1]($event);
  }

  public function dispatchAll(array $events): void
  {
    foreach ($events as $event) {
      $this->dispatch($event);
    }
  }
}
