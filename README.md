# luggsoft/chainable

[![Packagist Version](https://img.shields.io/packagist/v/luggsoft/chainable)](https://packagist.org/packages/luggsoft/chainable)
[![PHP Version](https://img.shields.io/packagist/php-v/luggsoft/chainable)](https://packagist.org/packages/luggsoft/chainable)
[![License](https://img.shields.io/github/license/luggsoft/luggsoft-php-chainable)](LICENSE)
[![CI](https://github.com/dan-lugg/php-luggsoft-chainable/actions/workflows/main.yml/badge.svg)](https://github.com/dan-lugg/php-luggsoft-chainable/actions/workflows/main.yml)

A fluent, method-chaining library for PHP. Wrap any value in a chainable interface and transform it through a pipeline of callables.

## Installation

```bash
composer require luggsoft/chainable
```

Requires PHP 8.1+.

## Quick Start

```php
use function Luggsoft\Chainable\chain;

$result = chain(123)
    ->then(fn(int $v): int => $v + 1)
    ->then(fn(int $v): int => $v * 2)
    ->into();

// 248
```

## How It Works

Every chainable pipeline has three parts:

1. **Entry point** — `chain()` wraps a value in a `ChainableInterface`.
2. **Transformations** (`->then(...)`, `->also(...)`) — apply callables to the wrapped value.
3. **Terminal** (`->into(...)`) — resolves and returns the final value.

## Entry Point

| Function | Description |
|----------|-------------|
| `chain(mixed)` | Wraps a value in a `ChainableInterface` |

## Methods

| Method | Description |
|--------|-------------|
| `then(callable): ChainableInterface` | Applies a callable to the wrapped value and returns a new chainable with the result |
| `also(callable): ChainableInterface` | Applies a side-effect callable and returns the same chainable instance (value unchanged) |
| `into(callable?): mixed` | Resolves the wrapped value, optionally applying a final callable |

## Examples

```php
use function Luggsoft\Chainable\chain;

// Basic transformation pipeline
$result = chain([1, 2, 3])
    ->then(fn(array $v): array => array_map(fn(int $x): int => $x * 2, $v))
    ->into();

// [2, 4, 6]
```

```php
// Side effects with also()
$log = [];
$result = chain('hello')
    ->also(fn(string $v): string => $log[] = "processing: $v")
    ->then(fn(string $v): string => strtoupper($v))
    ->into();

// $result = 'HELLO', $log = ['processing: hello']
```

```php
// Custom terminal
$result = chain('a,b,c')
    ->then(fn(string $v): array => explode(',', $v))
    ->into(fn(array $v): string => implode(' | ', $v));

// 'a | b | c'
```

## Development

```bash
composer install          # Install dependencies
composer test             # Run tests
composer analyse          # Static analysis (PHPStan)
composer cs               # Check code style
composer cs-fix           # Fix code style automatically
composer docs             # Generate API documentation
```

## License

`luggsoft/chainable` is open-sourced software licensed under the [MIT license](LICENSE).
