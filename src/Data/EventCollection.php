<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Data;

use DateTimeInterface;
use Everon\BankHolidays\Interfaces\EventCollectionInterface;
use Everon\BankHolidays\Interfaces\EventInterface;
use TypeError;

class EventCollection implements EventCollectionInterface
{
    /**
     * @var EventInterface[]
     */
    private $events;

    /**
     * EventCollection constructor.
     *
     * @param EventInterface[] $events
     */
    public function __construct(array $events = [])
    {
        $this->validateEventType($events);

        $this->events = $events;
    }

    /**
     * @param array $events
     */
    private function validateEventType(array $events): void
    {
        foreach ($events as $event) {
            if ($event instanceof EventInterface) {
                continue;
            }

            throw new TypeError('Event collection only accepts items of type: ' . EventInterface::class);
        }
    }

    /**
     * Count elements of an object
     *
     * @link  https://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->events);
    }

    public function filterArea(string $area): EventCollectionInterface
    {
        $items = array_filter($this->events,
            function (EventInterface $event) use ($area) {
                return $event->affectsArea($area);
            });

        return new EventCollection($items);
    }

    public function filterDateRange(DateTimeInterface $start, DateTimeInterface $end): EventCollectionInterface
    {
        $items = array_filter($this->events,
            function (EventInterface $event) use ($start, $end) {
                return $event->isInDateRange($start, $end);
            }
        );

        return new EventCollection($items);
    }

    public function toArray(): array
    {
        return $this->events;
    }
}