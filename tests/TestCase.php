<?php

declare(strict_types=1);

namespace Everon\BankHolidays\Tests;

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
}