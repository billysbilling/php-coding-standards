Ageras ApS PHP Coding Standards
==============================

This document describes the coding standards for PHP code written by Ageras ApS.

At Ageras ApS, we aim to maintain high-quality, consistent, and maintainable PHP code. These coding standards ensure compliance with PSR-12 and leverage modern tools to enhance code reliability and developer productivity.

## Table of Contents
1. [Installation](#installation)
2. [Configuration](#configuration)
   - [PHP CS Fixer Configuration](#php-cs-fixer-configuration)
   - [PHPStan Configuration](#phpstan-configuration)
3. [Usage](#usage)
4. [License](#license)
---

## Installation

To install the coding standards, run the following command:
```bash
composer require billysbilling/php-coding-standards --dev
```

### Versioning

Make sure to require a specific version of the package to maintain stability in your project. For example:
```bash
composer require billysbilling/php-coding-standards:^1.0 --dev
```

### Composer Scripts

Add the following scripts to the `scripts` section of your `composer.json` file to simplify usage:
```json
{
  "scripts": {
    "csfixer:fix": "vendor/bin/php-cs-fixer fix",
    "csfixer:check": "vendor/bin/php-cs-fixer fix --dry-run -vv",
    "phpstan:analyse": "php -d memory_limit=-1 vendor/bin/phpstan analyse --memory-limit=-1",
    "phpstan:generate-baseline": "php -d memory_limit=-1 vendor/bin/phpstan analyse --generate-baseline --memory-limit=-1"
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

use BillysBilling\PhpCodingStandards\PhpCsFixerConfig;

$config = new PhpCsFixerConfig();

// Exclude directories like vendor or legacy folders
$finder = PhpCsFixer\Finder::create()->in(__DIR__)->exclude(['vendor']);
$config->setFinder($finder);

return $config;
```

#### Relaxing Rules Temporarily

If you need to temporarily relax certain rules to support legacy code or incremental adoption, you can modify the `$rules` array:
```php
<?php

declare(strict_types=1);

use BillysBilling\PhpCodingStandards\PhpCsFixerConfig;

$config = new PhpCsFixerConfig();

$finder = PhpCsFixer\Finder::create()->in(__DIR__)->exclude(['vendor']);
$config->setFinder($finder);

// Temporary relaxation of the rules
$rules = $config->getRules();
$rules['declare_strict_types'] = false;
$rules['modernize_types_casting'] = false;
$rules['native_constant_invocation']  = false;
$rules['no_alias_functions'] = false;
$rules['strict_comparison'] = false;
$rules['strict_param'] = false;
$rules['void_return'] = false;
$config->setRules($rules);

return $config;
```
**Note**: Temporarily relaxing rules is intended for incremental migration of legacy code. Plan to re-enable these rules as you clean up the codebase.

---

### PHPStan Configuration

The default PHPStan configuration provided by Ageras ApS enforces strong static analysis to detect errors, bugs and coding standard violations.

#### Default Configuration

Create a `phpstan.neon` file in the root directory of your project:
```neon
includes:
    - vendor/billysbilling/php-coding-standards/phpstan.neon
```

#### Relaxing Rules Temporarily

```neon
includes:
    - vendor/billysbilling/php-coding-standards/phpstan.neon

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
composer phpstan:generate-baseline
```
This will save all current errors to `phpstan-baseline.neon`.

Include the generated baseline in your `phpstan.neon` file:
```neon
includes:
    - vendor/billysbilling/php-coding-standards/phpstan.neon
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

### Static Code Baseline Generation

Generate a baseline file for PHPStan to temporarily ignore existing issues in the codebase. This is especially useful for legacy projects:
```bash
composer phpstan:generate-baseline
```
This command runs PHPStan with the `--generate-baseline` option and creates a `phpstan-baseline.neon` file to record the current issues.

---

## License

This project is licensed under the proprietary license. See the [LICENSE](LICENSE) file for more details.

---

## Resources

For more information about the tools used in this project, refer to the official documentation:
- **PHP CS Fixer**: [Official Documentation](https://cs.symfony.com/)
- **PHPStan**: [Official Documentation](https://phpstan.org)
- **PSR-12 Coding Standard**: [PSR-12](https://www.php-fig.org/psr/psr-12/)
