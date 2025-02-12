<?php

namespace Luggsoft\Chainable;

/**
 * @param mixed $value
 * @return ChainableInterface
 */
function chain(mixed $value): ChainableInterface
{
    return new class($value) implements ChainableInterface {
        private mixed $value;

        /**
         * @param mixed $value
         */
        public function __construct(mixed $value)
        {
            $this->value = $value;
        }

        /**
         * @param callable(mixed):mixed $callable
         * @return ChainableInterface
         */
        public function then(callable $callable): ChainableInterface
        {
            return new static($callable($this->value));
        }

        /**
         * @param callable(mixed):void $callable
         * @return ChainableInterface
         */
        public function also(callable $callable): ChainableInterface
        {
            $callable($this->value);
            return $this;
        }

        /**
         * @param callable(mixed):mixed|null $callable
         * @return mixed
         */
        public function into(callable|null $callable = null): mixed
        {
            return ($callable ?? fn() => $this->value)($this->value);
        }
    };
}
