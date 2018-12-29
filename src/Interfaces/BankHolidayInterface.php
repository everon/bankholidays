<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Interfaces;

interface BankHolidayInterface
{
    /**
     * Retrieve the bank holiday events
     * @return EventCollectionInterface
     */
    public function getEvents():EventCollectionInterface;
}