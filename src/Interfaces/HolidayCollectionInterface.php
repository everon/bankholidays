<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Interfaces;

use Countable;
use DateTimeInterface;

interface HolidayCollectionInterface extends Countable
{
    public function filterArea(string $area);

    public function filterDateRange(DateTimeInterface $start, DateTimeInterface $end);

    public function toArray(): array;
}