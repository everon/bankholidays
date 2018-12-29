<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Interfaces;

use Countable;
use DateTimeInterface;

/**
 * Interface EventCollectionInterface
 *
 * @package Everon\BankHolidays\Interfaces
 * Immutable Event Collection
 */
interface EventCollectionInterface extends Countable
{
    public function filterArea(string $area): EventCollectionInterface;

    public function filterDateRange(DateTimeInterface $start, DateTimeInterface $end): EventCollectionInterface;

    public function toArray(): array;
}