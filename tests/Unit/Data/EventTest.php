<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Tests\Unit\Data;

use DateTimeImmutable;
use Everon\BankHolidays\Data\Event;
use Everon\BankHolidays\Interfaces\EventInterface;
use Everon\BankHolidays\Tests\TestCase;

/**
 * Class EventTest
 *
 * @package Everon\BankHolidays\Tests\Unit\Data
 * @coversDefaultClass \Everon\BankHolidays\Data\Event
 */
class EventTest extends TestCase
{
    /**
     * @var Event
     */
    private $event;

    /**
     * @throws \Everon\BankHolidays\Exceptions\BankHolidayException
     * @throws \Exception
     */
    protected function setUp()
    {
        parent::setUp();

        $this->event =
            new Event('Test',
                      new DateTimeImmutable('1988-11-26'),
                      EventInterface::AREA_ENGLAND_WALES,
                      'Some notes',
                      true
            );
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function itCanBeCreated()
    {
        $this->assertInstanceOf(EventInterface::class, $this->event);
    }


    /**
     * @test
     * @covers ::validateArea
     * @throws \Everon\BankHolidays\Exceptions\BankHolidayException
     * @throws \Exception
     * @expectedException \Everon\BankHolidays\Exceptions\BankHolidayException
     * @expectedExceptionMessageRegExp /Invalid area: (.+)/
     */
    public function itWillValidateTheArea(): void
    {
        new Event('', new DateTimeImmutable(), 'Blah', '', true);
    }

    /**
     * @test
     * @covers ::getTitle
     */
    public function itCanGetTheTitle(): void
    {
        $this->assertSame('Test', $this->event->getTitle());
    }

    /**
     * @test
     * @covers ::getDate
     */
    public function itCanGetTheDate(): void
    {
        $this->assertSame('1988-11-26', $this->event->getDate()->format('Y-m-d'));
    }

    /**
     * @test
     * @covers ::hasBunting
     */
    public function itCanCheckIfBunting(): void
    {
        $this->assertSame(true, $this->event->hasBunting());
    }

    /**
     * @test
     * @covers ::getNotes
     */
    public function itCanGetTheNotes(): void
    {
        $this->assertSame('Some notes', $this->event->getNotes());
    }

    /**
     * @test
     * @covers ::getArea
     */
    public function itCanGetTheArea(): void
    {
        $this->assertSame(EventInterface::AREA_ENGLAND_WALES, $this->event->getArea());
    }

    /**
     * @test
     * @covers ::affectsArea
     * @dataProvider providesArea
     *
     * @param string $area
     * @param bool   $expect
     */
    public function itCanCompareTheArea(string $area, bool $expect): void
    {
        $this->assertSame($expect, $this->event->affectsArea($area));
    }

    public function providesArea(): array
    {
        return [
            'Same is true' => ['area' => EventInterface::AREA_ENGLAND_WALES, 'expect' => true],
            'Different is false' => ['area' => EventInterface::AREA_SCOTLAND, 'expect' => false],
        ];
    }
}
