<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Tests\Unit\Data;

use Everon\BankHolidays\Data\EventFactory;
use Everon\BankHolidays\Interfaces\EventInterface;
use Everon\BankHolidays\Tests\TestCase;

/**
 * Class EventFactoryTest
 *
 * @package Everon\BankHolidays\Tests\Unit\Data
 * @coversDefaultClass \Everon\BankHolidays\Data\EventFactory
 */
class EventFactoryTest extends TestCase
{
    /**
     * @var EventFactory
     */
    private $factory;

    public function setUp()
    {
        parent::setUp();

        $this->factory = new EventFactory();
    }

    /**
     * @test
     * @covers ::validateData
     * @dataProvider providesInvalidData
     * @expectedException \Everon\BankHolidays\Exceptions\BankHolidayException
     * @expectedExceptionMessageRegExp /Required event key (.+) missing/
     *
     * @param array $data
     */
    public function itWillValidateAllDataIsPresent(array $data)
    {
        $this->factory->make($data, EventInterface::AREA_ENGLAND_WALES);
    }

    public function providesInvalidData(): array
    {
        $data = json_decode($this->getAsset('event.json'), true);
        $result = [];

        foreach(EventFactory::EXPECTED_KEYS as $required)
        {
            $temp = $data;
            unset($temp[$required]);
            $result[] = ['data' => $temp];
        }
        return $result;
    }
}