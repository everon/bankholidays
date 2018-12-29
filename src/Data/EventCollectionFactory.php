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
     * @throws \Everon\BankHolidays\Exceptions\BankHolidayException
     */
    public function make(array $data): EventCollectionInterface
    {
        $items = [];

        // Extract the events from each division
        foreach ($data as $divisionContainer) {

            $divisionName = $divisionContainer['division'];
            foreach ($divisionContainer['events'] as $event) {

                // Fire the event data through the event factory with the division
                $items[] = $this->factory->make($event, $divisionName);
            }
        }

        // Put the result in to the event collection to provide the API for traversing the events
        return new EventCollection($items);
    }
}