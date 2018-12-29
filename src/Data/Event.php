<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Data;

use DateTimeImmutable;
use DateTimeInterface;
use Everon\BankHolidays\Exceptions\BankHolidayException;
use Everon\BankHolidays\Interfaces\EventInterface;

final class Event implements EventInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var string
     */
    private $area;

    /**
     * @var string
     */
    private $notes;

    /**
     * @var bool
     */
    private $hasBunting;

    /**
     * Event constructor.
     *
     * @param string            $title
     * @param DateTimeImmutable $date
     * @param string            $area
     * @param string            $notes
     * @param bool              $hasBunting
     *
     * @throws BankHolidayException
     */
    public function __construct(string $title, DateTimeImmutable $date, string $area, string $notes, bool $hasBunting)
    {
        $this->validateArea($area);

        $this->title      = $title;
        $this->date       = $date;
        $this->area       = $area;
        $this->notes      = $notes;
        $this->hasBunting = $hasBunting;
    }

    /**
     * @param string $area
     *
     * @throws BankHolidayException
     */
    private function validateArea(string $area): void
    {
        if (!in_array($area, self::AREAS, true)) {
            throw new BankHolidayException('Invalid area: ' . $area);
        }
    }

    /**
     * Title of the holiday
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Date this occurs on
     *
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Misc notes
     *
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * Is Bunting used?
     *
     * @return bool
     */
    public function hasBunting(): bool
    {
        return $this->hasBunting;
    }

    /**
     * Get the area code
     *
     * @return string
     */
    public function getArea(): string
    {
        return $this->area;
    }

    /**
     * Checks if this is part of the passed area
     *
     * @param string $area
     *
     * @return bool
     */
    public function affectsArea(string $area): bool
    {
        return $this->area === $area;
    }
}