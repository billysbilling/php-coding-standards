Ageras ApS PHP Coding Standards
==============================

This document describes the coding standards for PHP code written by Ageras ApS.

## Table of Contents
1. [Installation](#installation)
2. [Configuration](#configuration)
    1. [PHP CS Fixer Configuration](#php-cs-fixer-configuration)
    2. [PHPStan Configuration](#phpstan-configuration)
3. [Usage](#usage)
4. [License](#license)
---

## Installation

To install the coding standards, run the following command:
```bash
composer require ageras/php-coding-standards --dev
```

### Versioning

Make sure to require a specific version of the package to maintain stability in your project. For example:
```bash
composer require ageras/php-coding-standards:^1.0 --dev
```

### Composer Scripts

Add the following scripts to the `scripts` section of your `composer.json` file to simplify usage:
```json
{
  "scripts": {
    "csfixer:fix": "vendor/bin/php-cs-fixer fix",
    "csfixer:check": "vendor/bin/php-cs-fixer fix --dry-run -vvv",
    "phpstan:analyse": "vendor/bin/phpstan analyse"
  }
}
```

---
## Configuration

### PHP CS Fixer Configuration

The default PHP CS Fixer configuration provided by Ageras ApS ensures compliance with PSR-12 and enforces modern PHP coding standards. It includes rules such as:
- **Array syntax**: Short array syntax `[]` instead of `array()`.
- **Strict typing**: Enables strict types for all files.
- **Modernizations**: Removes legacy function aliases and uses modern casting.

#### Default Configuration

To use the default PHP CS Fixer configuration provided by Ageras ApS, create a `.php-cs-fixer.php` file in the root directory of your project with the following content:
```php
<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['vendor']); // Exclude directories like vendor or legacy folders

$config = new PhpCsFixer\Config();

// Import default rules from the package
$rules = require 'vendor/billysbilling/php-coding-standards/.php-cs-fixer.php';

return $config
    ->setFinder($finder)
    ->setRules($rules)
    ->setRiskyAllowed(true)
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setCacheFile(__DIR__.'/.php-cs-fixer.cache')
    ->setUsingCache(true);
```

#### Relaxing Rules Temporarily

If you need to temporarily relax certain rules to support legacy code or incremental adoption, you can modify the `$rules` array:
```php
// Example: Temporarily relax some rules
$rules['declare_strict_types'] = false;
$rules['modernize_types_casting'] = false;
$rules['native_constant_invocation'] = false;
$rules['no_alias_functions'] = false;
$rules['strict_comparison'] = false;
$rules['strict_param'] = false;
$rules['void_return'] = false;
```
**Note**: Temporarily relaxing rules is intended for incremental migration of legacy code. Plan to re-enable these rules as you clean up the codebase.

---

### PHPStan Configuration

The default PHPStan configuration provided by Ageras ApS enforces strong static analysis to detect errors, bugs and coding standard violations.

#### Default Configuration

Create a `phpstan.neon` file in the root directory of your project:
```neon
includes:
    - vendor/ageras/php-coding-standards/phpstan.neon
```

#### Relaxing Rules Temporarily

```neon
includes:
    - vendor/ageras/php-coding-standards/phpstan.neon

parameters:
    level: max # Maximum analysis level for strict checks
    paths: # Define the paths to analyze
        - src
        - tests
    ignoreErrors: # Optionally ignore errors in specific paths
        -
            message: '#.*#'
            paths:
                - src/legacy/*
                - tests/legacy/*
```
**Note**: Temporarily relaxing rules is intended for incremental migration of legacy code. Plan to re-enable these rules as you clean up the codebase.

#### Handling Existing Issues with PHPStan Baseline

When working with legacy codebases, you may encounter many errors during static analysis. PHPStan provides a baseline feature that allows you to temporarily ignore existing errors while focusing on new issues.

Run the following command to generate a `phpstan-baseline.neon` file:
```bash
vendor/bin/phpstan analyse --generate-baseline
```
This will save all current errors to `phpstan-baseline.neon`.

Include the generated baseline in your `phpstan.neon` file:
```neon
includes:
    - vendor/ageras/php-coding-standards/phpstan.neon
    - phpstan-baseline.neon
```
**Note**: The baseline file serves as a temporary solution. You should gradually address the errors listed in the baseline to achieve full compliance.

---

## Usage

### Fix Code Style Issues

Automatically fix code style violations based on Ageras ApS PHP Coding Standards:
```bash
composer csfixer:fix
```
This command runs PHP CS Fixer and applies the defined coding standards to your codebase.

### Check Code Style

Validate the codebase for style violations without applying changes. This is particularly useful for development workflows and CI/CD pipelines:
```bash
composer csfixer:check
```
This command runs PHP CS Fixer in dry-run mode and outputs any violations it finds.

### Static Code Analysis

Perform static analysis to detect bugs, potential issues, or deviations from coding standards:
```bash
composer phpstan:analyse
```
This command runs PHPStan to analyze the codebase and report any errors or inconsistencies.

---

## License

This project is licensed under the proprietary license. See the [LICENSE](LICENSE) file for more details.

---

## Resources

For more information about the tools used in this project, refer to the official documentation:
- **PHP CS Fixer**: [Official Documentation](https://cs.symfony.com/)
- **PHPStan**: [Official Documentation](https://phpstan.org)
- **PSR-12 Coding Standard**: [PSR-12](https://www.php-fig.org/psr/psr-12/)
