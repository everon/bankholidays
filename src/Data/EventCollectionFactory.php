<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Data;

use Everon\BankHolidays\Interfaces\EventCollectionInterface;

class EventCollectionFactory
{
    /**
     * @var EventFactory
     */
    private $factory;

    public function __construct(EventFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param array $data
     *
     * @return EventCollectionInterface
     */
    public function make(array $data): EventCollectionInterface
    {
        return new EventCollection($data);
    }
}