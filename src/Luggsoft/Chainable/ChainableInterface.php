<?php

namespace Luggsoft\Chainable;

interface ChainableInterface
{
    /**
     * Invokes a function on the state and returns a new {@see ChainableInterface} with it's state set to the result of the function.
     *
     * @param (callable():mixed) $callable The function to call with the current state as an argument.
     * @return ChainableInterface A new {@see ChainableInterface} with the result of `$callable` as it's state.
     */
    public function then(callable $callable): ChainableInterface;

    /**
     * Invokes a function on the state and returns the original {@see ChainableInterface}.
     *
     * @param (callable():void) $callable The function to call with the current state as an argument.
     * @return ChainableInterface The same {@see ChainableInterface}.
     */
    public function also(callable $callable): ChainableInterface;

    /**
     * Invokes an optional function on the state and returns the state.
     *
     * @param (callable():mixed)|null $callable The function to call with the current state as an argument.
     * @return mixed The result of `$callable`.
     */
    public function into(callable|null $callable = null): mixed;
}

