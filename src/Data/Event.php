<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Data;

use DateTimeImmutable;
use DateTimeInterface;
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

    public function __construct(string $title, DateTimeImmutable $date, string $area, string $notes, bool $hasBunting)
    {
        $this->title      = $title;
        $this->date       = $date;
        $this->area       = $area;
        $this->notes      = $notes;
        $this->hasBunting = $hasBunting;
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