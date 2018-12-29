<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Tests\Integration\Api;

use Everon\BankHolidays\Api\Client;
use Everon\BankHolidays\Tests\TestCase;

/**
 * Class ClientTest
 *
 * @package Everon\UkBankHolidays\Tests\Integration
 * @coversDefaultClass \Everon\BankHolidays\Api\Client
 */
class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = new Client();
    }

    /**
     * @test
     * @covers ::getDataFromApi
     * @throws \Everon\BankHolidays\Exceptions\BankHolidayException
     */
    public function itCanGetTheDataFromTheApi(): void
    {
        $result = $this->client->getData();

        $this->assertArrayHasKey('england-and-wales', $result);
    }
}
