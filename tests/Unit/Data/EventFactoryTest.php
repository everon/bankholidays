<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Tests\Unit\Data;

use DateTimeImmutable;
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
     * @dataProvider                   providesInvalidData
     * @expectedException \Everon\BankHolidays\Exceptions\BankHolidayException
     * @expectedExceptionMessageRegExp /Required event key (.+) missing/
     *
     * @param array $data
     */
    public function itWillValidateAllDataIsPresent(array $data): void
    {
        $this->factory->make($data, EventInterface::AREA_ENGLAND_WALES);
    }

    public function providesInvalidData(): array
    {
        $data   = $this->getAssetJson('event.json');
        $result = [];

        foreach (EventFactory::EXPECTED_KEYS as $required) {
            $temp = $data;
            unset($temp[$required]);
            $result[] = ['data' => $temp];
        }

        return $result;
    }

    /**
     * @test
     * @covers ::validateData
     * @throws \Everon\BankHolidays\Exceptions\BankHolidayException
     */
    public function itWillPassValidation(): void
    {
        $this->factory->make($this->getAssetJson('event.json'), EventInterface::AREA_SCOTLAND);

        $this->addToAssertionCount(1);
    }


    /**
     * @test
     * @covers ::make
     * @throws \Everon\BankHolidays\Exceptions\BankHolidayException
     * @throws \Exception
     */
    public function itCanCreateTheEvent(): void
    {
        $data  = $this->getAssetJson('event.json');
        $event = $this->factory->make($data, EventInterface::AREA_ENGLAND_WALES);

        $this->assertSame($data['title'], $event->getTitle());
        $this->assertSame($data['notes'], $event->getNotes());
        $this->assertSame($data['bunting'], $event->hasBunting());
        $this->assertEquals($data['date'], $event->getDate()->format('Y-m-d'));
    }
}