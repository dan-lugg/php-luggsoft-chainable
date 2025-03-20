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
         * {@inheritdoc}
         */
        public function then(callable $callable): ChainableInterface
        {
            return new static($callable($this->value));
        }

        /**
         * {@inheritdoc}
         */
        public function also(callable $callable): ChainableInterface
        {
            $callable($this->value);
            return $this;
        }

        /**
         * {@inheritdoc}
         */
        public function into(callable|null $callable = null): mixed
        {
            return ($callable ?? fn() => $this->value)($this->value);
        }
    };
}
