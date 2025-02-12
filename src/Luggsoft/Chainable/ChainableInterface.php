<?php

namespace Luggsoft\Chainable;

interface ChainableInterface
{
    /**
     * @param callable $callable
     * @return ChainableInterface
     */
    public function then(callable $callable): ChainableInterface;

    /**
     * @param callable $callable
     * @return ChainableInterface
     */
    public function also(callable $callable): ChainableInterface;

    /**
     * @param callable|null $callable
     * @return mixed
     */
    public function into(callable|null $callable = null): mixed;
}

