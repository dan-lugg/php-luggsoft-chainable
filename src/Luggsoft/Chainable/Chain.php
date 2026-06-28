<?php

declare(strict_types=1);

namespace Luggsoft\Chainable;

/**
 * Creates a new chainable instance wrapping the given value.
 *
 * @param mixed $value The value to wrap.
 * @return ChainableInterface A new {@see ChainableInterface} wrapping the given value.
 */
function chain(mixed $value): ChainableInterface
{
    return new class ($value) implements ChainableInterface {
        private mixed $value;

        /**
         * @param mixed $value The value to wrap.
         */
        public function __construct(mixed $value)
        {
            $this->value = $value;
        }

        /**
         * Applies a callable to the wrapped value and returns a new chainable with the result.
         *
         * @param callable $callable The callable to apply to the wrapped value.
         * @return ChainableInterface A new {@see ChainableInterface} wrapping the result of the callable.
         */
        public function then(callable $callable): ChainableInterface
        {
            return new static($callable($this->value));
        }

        /**
         * Applies a callable to the wrapped value and returns the same chainable instance.
         *
         * @param callable $callable The callable to apply to the wrapped value.
         * @return ChainableInterface The same {@see ChainableInterface} instance.
         */
        public function also(callable $callable): ChainableInterface
        {
            $callable($this->value);

            return $this;
        }

        /**
         * Resolves the wrapped value, optionally applying a callable first.
         *
         * @param callable|null $callable An optional callable to apply to the wrapped value.
         * @return mixed The result of the callable, or the wrapped value if no callable is provided.
         */
        public function into(callable | null $callable = null): mixed
        {
            return ($callable ?? fn () => $this->value)($this->value);
        }
    };
}
