<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Tests;

use Mockery\MockInterface;

class TestCase extends \PHPUnit\Framework\TestCase
{
    private const ASSET_DIR = __DIR__ . '/Assets/';

    /**
     * @param string $path
     *
     * @return string
     */
    protected function getAsset(string $path): string
    {
        $fullPath = self::ASSET_DIR . $path;
        if (!file_exists($fullPath)) {
            $this->fail('Asset file does not exist: ' . $fullPath);
        }

        $data = file_get_contents($fullPath);

        if ($data === false) {
            $this->fail('Could not read asset file: ' . $fullPath);
        }

        return $data;
    }

    protected function getAssetJson(string $path): array
    {
        $data = $this->getAsset($path);

        $result = json_decode($data, true);

        if ($result === null) {
            $this->fail('Could not decode json: ' . $path);
        }

        return $result;
    }

    protected function tearDown()
    {
        \Mockery::close();

        parent::tearDown();
    }

    protected function mock(string $class): MockInterface
    {
        return \Mockery::mock($class);
    }


}