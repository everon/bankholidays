<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Tests\Integration\Api;

use Everon\BankHolidays\Api\Client;
use Everon\BankHolidays\Exceptions\BankHolidayException;
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
     * @covers ::__construct
     */
    public function itCanBeInstantiated(): void
    {
        (new Client());

        $this->addToAssertionCount(1);
    }


    /**
     * @test
     * @covers ::getData
     * @throws \Everon\BankHolidays\Exceptions\BankHolidayException
     */
    public function itCanGetTheDataFromTheApi(): void
    {
        $result = $this->client->getData();

        $this->assertArrayHasKey('england-and-wales', $result);
    }

    /**
     * @test
     * @covers ::getData
     * @throws \Everon\BankHolidays\Exceptions\BankHolidayException
     * @expectedException \Everon\BankHolidays\Exceptions\BankHolidayException
     * @expectedExceptionMessage Could not retrieve data from API
     */
    public function itWillThrowAnExceptionOnFetchFailure():void
    {
        (new Client('www.somefakeandunlikelytoexistwebsite.dev'))->getData();
    }

    /**
     * @test
     * @covers ::getData
     * @throws BankHolidayException
     * @expectedException \Everon\BankHolidays\Exceptions\BankHolidayException
     * @expectedExceptionMessage Could not decode data from API
     */
    public function itWillThrowAnExceptionIfResponseIsNotJson():void
    {
        (new Client('http://www.example.com'))->getData();
    }
}
