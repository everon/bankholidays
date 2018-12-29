<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Api;

use Everon\BankHolidays\Exceptions\BankHolidayException;
use Everon\BankHolidays\Interfaces\ClientInterface;

class Client implements ClientInterface
{
    /**
     * @var string
     */
    private $source;

    public function __construct(string $source = ClientInterface::DEFAULT_SOURCE)
    {
        $this->source = $source;
    }

    /**
     * @return array
     * @throws BankHolidayException
     */
    public function getData(): array
    {
        $payload = @file_get_contents($this->source);
        if ($payload === false) {
            throw new BankHolidayException('Could not retrieve data from API');
        }

        $data = json_decode($payload, true);
        if ($data === null) {
            throw new BankHolidayException('Could not decode data from API');
        }

        return $data;
    }
}