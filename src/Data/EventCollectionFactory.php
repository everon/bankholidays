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
        // Extract the events from each division

        // Fire the event data through the event factory with the division

        // Put the result in to the event collection to provide the API for traversing the events
        
        return new EventCollection($data);
    }
}