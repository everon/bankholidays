<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Data;

use DateTimeInterface;
use Everon\BankHolidays\Interfaces\EventCollectionInterface;
use Everon\BankHolidays\Interfaces\EventInterface;

class EventCollection implements EventCollectionInterface
{
    /**
     * @var EventInterface[]
     */
    private $events;

    /**
     * EventCollection constructor.
     *
     * @param array $events
     */
    public function __construct(array $events = [])
    {
        $this->events = $events;
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

    public function filterArea(string $area)
    {
        // TODO: Implement filterArea() method.
    }

    public function filterDateRange(DateTimeInterface $start, DateTimeInterface $end)
    {
        // TODO: Implement filterDateRange() method.
    }

    public function toArray(): array
    {
        // TODO: Implement toArray() method.
    }
}