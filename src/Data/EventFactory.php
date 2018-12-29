<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Data;

use DateTimeImmutable;
use Everon\BankHolidays\Exceptions\BankHolidayException;
use Everon\BankHolidays\Interfaces\EventInterface;

class EventFactory
{
    public const EXPECTED_KEYS = [
        'title',
        'date',
        'notes',
        'bunting',
    ];

    /**
     * @param array  $data
     * @param string $area
     *
     * @return EventInterface
     * @throws BankHolidayException
     * @throws \Exception
     */
    public function make(array $data, string $area): EventInterface
    {
        $this->validateData($data);

        return new Event($data['title'], new DateTimeImmutable($data['date']), $area, $data['notes'], $data['bunting']);
    }

    /**
     * @param $data
     *
     * @throws BankHolidayException
     */
    private function validateData($data): void
    {
        foreach (self::EXPECTED_KEYS as $requiredKey) {
            if (!array_key_exists($requiredKey, $data)) {
                throw new BankHolidayException('Required event key "' . $requiredKey . '" missing');
            }
        }
    }
}