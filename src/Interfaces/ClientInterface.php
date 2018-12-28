<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Interfaces;

interface ClientInterface
{
    public const DEFAULT_SOURCE = 'https://www.gov.uk/bank-holidays.json';

    /**
     * @return array
     */
    public function getData(): array;
}