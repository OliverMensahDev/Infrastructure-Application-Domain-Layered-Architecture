<?php

declare(strict_types=1);


namespace App\Domain\Common;

trait EventRecordingCapabilities
{
  /**
   * @var array & object[]
   */
  private $events = [];

  protected function recordThat(object $event): void
  {
    $this->events[] = $event;
  }

  /**
   * @return array & object[]
   */
  final public function releaseEvents(): array
  {
    $events = $this->events;

    $this->events = [];

    return $events;
  }
}
