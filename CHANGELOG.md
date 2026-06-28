# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/), and this project adheres to [Semantic Versioning](https://semver.org/).

## [1.0.0] - 2025-02-12

### Added

- Initial release.
- `chain()` — wraps a value in a chainable interface.
- `then()` — applies a transformation to the wrapped value.
- `also()` — applies a side-effect without changing the wrapped value.
- `into()` — resolves the wrapped value, optionally through a callable.
- `ChainableInterface` — contract for the chainable type.
- PHPUnit 10.5 test suite.
- phpDocumentor 3 configuration for API docs generation.
- Comprehensive docblocks with summary lines and parameter/return descriptions.
