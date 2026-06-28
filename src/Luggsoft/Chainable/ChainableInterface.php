<?php

declare(strict_types=1);

namespace Luggsoft\Chainable;

interface ChainableInterface
{
    /**
     * Applies a callable to the wrapped value and returns a new chainable with the result.
     *
     * @param (callable(mixed):mixed) $callable The callable to apply to the current state.
     * @return ChainableInterface A new {@see ChainableInterface} wrapping the result of the callable.
     */
    public function then(callable $callable): ChainableInterface;

    /**
     * Applies a side-effect callable to the wrapped value and returns the same chainable instance.
     *
     * @param (callable(mixed):mixed) $callable The callable to apply to the current state.
     * @return ChainableInterface The same {@see ChainableInterface} instance (value unchanged).
     */
    public function also(callable $callable): ChainableInterface;

    /**
     * Resolves the wrapped value, optionally applying a final callable first.
     *
     * @param (callable(mixed):mixed)|null $callable An optional callable to apply to the current state.
     * @return mixed The result of the callable, or the wrapped value if no callable is provided.
     */
    public function into(callable | null $callable = null): mixed;
}
