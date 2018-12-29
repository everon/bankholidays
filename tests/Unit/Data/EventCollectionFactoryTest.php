<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Tests\Unit\Data;

use Everon\BankHolidays\Data\EventCollectionFactory;
use Everon\BankHolidays\Data\EventFactory;
use Everon\BankHolidays\Interfaces\EventCollectionInterface;
use Everon\BankHolidays\Tests\TestCase;

/**
 * Class EventCollectionFactoryTest
 *
 * @package Everon\BankHolidays\Tests\Unit\Data
 * @coversDefaultClass \Everon\BankHolidays\Data\EventCollectionFactory
 */
class EventCollectionFactoryTest extends TestCase
{
    /**
     * @var EventCollectionFactory
     */
    private $factory;

    protected function setUp()
    {
        parent::setUp();

        $this->factory = new EventCollectionFactory(new EventFactory());
    }

    /**
     * @test
     * @covers ::make
     */
    public function itCanCreateAnEventCollection(): void
    {
        $result = $this->factory->make([]);

        $this->assertInstanceOf(EventCollectionInterface::class, $result);
    }
}