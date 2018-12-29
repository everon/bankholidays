<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Tests\Unit\Data;

use DateTimeImmutable;
use Everon\BankHolidays\Data\Event;
use Everon\BankHolidays\Data\EventCollection;
use Everon\BankHolidays\Interfaces\EventInterface;
use Everon\BankHolidays\Tests\TestCase;
use Mockery\MockInterface;
use TypeError;

/**
 * Class EventCollectionTest
 *
 * @package Everon\BankHolidays\Tests\Unit\Data
 * @coversDefaultClass \Everon\BankHolidays\Data\EventCollection
 */
class EventCollectionTest extends TestCase
{
    /**
     * @test
     * @covers ::validateEventType
     * @expectedException TypeError
     */
    public function itWillThrowErrorOnBadTypeInConstructorArray(): void
    {
        $this->expectExceptionMessage('Event collection only accepts items of type: ' . EventInterface::class);

        new EventCollection(['error expected']);
    }

    /**
     * @test
     * @covers ::validateEventType
     * @throws \Everon\BankHolidays\Exceptions\BankHolidayException
     * @throws \Exception
     */
    public function itWillOnlyAcceptCertainTypes(): void
    {
        new EventCollection([new Event('', new DateTimeImmutable(), 'scotland', '', true)]);

        $this->addToAssertionCount(1);
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function itCanBeInstantiated(): void
    {
        new EventCollection([]);

        $this->addToAssertionCount(1);
    }

    /**
     * @test
     * @covers ::count
     */
    public function itCanCountTheItems(): void
    {
        $collection = new EventCollection(
            [
                $this->mock(EventInterface::class),
                $this->mock(EventInterface::class),
            ]
        );

        $this->assertCount(2, $collection);
    }

    /**
     * @test
     * @covers ::filterArea
     */
    public function itCanFilterByArea(): void
    {
        $expected    = $this->mock(EventInterface::class)->allows(['affectsArea' => true]);
        $notExpected = $this->mock(EventInterface::class)->allows(['affectsArea' => false]);

        $collection = new EventCollection(
            [
                $expected,
                $notExpected,
            ]
        );

        $this->assertContains($expected, $collection->filterArea('abc')->toArray());
        $this->assertNotContains($notExpected, $collection->filterArea('abc')->toArray());
    }

    /**
     * @test
     * @covers ::filterDateRange
     * @throws \Exception
     */
    public function itCanFilterByDateRange(): void
    {
        $mockFactory = function (bool $result, DateTimeImmutable $start, DateTimeImmutable $end): MockInterface {
            return $this->mock(EventInterface::class)
                        ->shouldReceive('isInDateRange')
                        ->with($start, $end)
                        ->andReturn($result)
                        ->getMock();
        };

        $date = new DateTimeImmutable();

        $expected = [
            $mockFactory(true, $date, $date),
            $mockFactory(true, $date, $date),
            $mockFactory(true, $date, $date),
        ];

        $notExpected = [
            $mockFactory(false, $date, $date),
            $mockFactory(false, $date, $date),
        ];

        $collection = new EventCollection(array_merge($expected, $notExpected));

        $result = $collection->filterDateRange($date, $date)->toArray();

        foreach ($expected as $item) {
            $this->assertContains($item, $result);
        }

        $this->assertCount(count($expected), $result);
    }

    /**
     * @test
     * @covers ::toArray
     */
    public function itCanConvertToArray(): void
    {
        $expected = [
            $this->mock(EventInterface::class),
            $this->mock(EventInterface::class),
        ];

        $this->assertSame($expected, (new EventCollection($expected))->toArray());
    }
}