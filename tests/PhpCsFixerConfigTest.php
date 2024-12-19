<?php

declare(strict_types=1);

use BillysBilling\PhpCodingStandards\PhpCsFixerConfig;
use PHPUnit\Framework\TestCase;

class PhpCsFixerConfigTest extends TestCase
{
    public function testGetRulesReturnsArray(): void
    {
        $config = new PhpCsFixerConfig();
        $rules = $config->getRules();

        self::assertIsArray($rules, 'getRules() should return an array.');
    }

    public function testGetRulesContainsExpectedRules(): void
    {
        $config = new PhpCsFixerConfig();
        $rules = $config->getRules();

        self::assertArrayHasKey('@PSR12', $rules, 'getRules() should include "@PSR12".');
        self::assertTrue($rules['@PSR12'], 'The "@PSR12" rule should be enabled.');

        self::assertArrayHasKey('array_syntax', $rules, 'getRules() should include "array_syntax".');
        self::assertEquals(['syntax' => 'short'], $rules['array_syntax'], 'The "array_syntax" rule should enforce short syntax.');

        self::assertArrayHasKey('declare_strict_types', $rules, 'getRules() should include "declare_strict_types".');
        self::assertTrue($rules['declare_strict_types'], 'The "declare_strict_types" rule should be enabled.');
    }

    public function testGetUsingCacheReturnsTrue(): void
    {
        $config = new PhpCsFixerConfig();
        $usingCache = $config->getUsingCache();

        self::assertTrue($usingCache, 'getUsingCache() should return true.');
    }

    public function testGetRiskyAllowedReturnsTrue(): void
    {
        $config = new PhpCsFixerConfig();
        $riskyAllowed = $config->getRiskyAllowed();

        self::assertTrue($riskyAllowed, 'getRiskyAllowed() should return true.');
    }
}
