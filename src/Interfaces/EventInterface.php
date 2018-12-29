<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Interfaces;

use DateTimeInterface;

interface EventInterface
{
    public const AREAS = [
        'england-and-wales',
        'scotland',
        'northern-ireland'
    ];

    /**
     * Title of the holiday
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Date this occurs on
     *
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface;

    /**
     * Misc notes
     *
     * @return string
     */
    public function getNotes(): string;

    /**
     * Is Bunting used?
     *
     * @return bool
     */
    public function hasBunting(): bool;

    /**
     * Get the area code
     *
     * @return string
     */
    public function getArea(): string;

    /**
     * Checks if this is part of the passed area
     *
     * @param string $area
     *
     * @return bool
     */
    public function affectsArea(string $area): bool;

}