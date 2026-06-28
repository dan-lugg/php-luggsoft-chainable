<?php

declare(strict_types=1);

namespace Luggsoft\Chainable;

use PHPUnit\Framework\TestCase;

class ChainableInterfaceTest extends TestCase
{
    public function test_then_into(): void
    {
        $result = chain(123)
            ->then(fn (int $v) => $v + 1)
            ->then(fn (int $v) => $v * 2)
            ->into();

        $this->assertSame(248, $result);
    }

    public function test_then_also_into(): void
    {
        $refers = 0;
        $result = chain(123)
            ->then(fn (int $v) => $v + 1)
            ->also(function (int $v) use (&$refers) {
                $refers = $v;
            })
            ->then(fn (int $v) => $v * 2)
            ->into();

        $this->assertSame(248, $result);
        $this->assertSame(124, $refers);
    }

    public function test_also_standalone_returns_same_instance(): void
    {
        $chain = chain(42);
        $result = $chain->also(fn (int $v) => $v);

        $this->assertSame($chain, $result);
    }

    public function test_also_standalone_value_unchanged(): void
    {
        $log = [];
        $result = chain(42)
            ->also(function (int $v) use (&$log) {
                $log[] = $v;
            })
            ->into();

        $this->assertSame(42, $result);
        $this->assertSame([42], $log);
    }

    public function test_into_with_callable(): void
    {
        $result = chain(7)
            ->into(fn (int $v) => $v * 2);

        $this->assertSame(14, $result);
    }

    public function test_into_with_null_value(): void
    {
        $result = chain(null)
            ->into();

        $this->assertNull($result);
    }

    public function test_into_explicit_null(): void
    {
        $result = chain('hello')
            ->into(null);

        $this->assertSame('hello', $result);
    }

    public function test_chain_with_array_value(): void
    {
        $result = chain([1, 2, 3])
            ->then(fn (array $v) => count($v))
            ->into();

        $this->assertSame(3, $result);
    }

    public function test_chain_with_string_value(): void
    {
        $result = chain('hello')
            ->then(fn (string $v) => strtoupper($v))
            ->into();

        $this->assertSame('HELLO', $result);
    }

    public function test_also_object_mutation(): void
    {
        $obj = new \stdClass();
        $result = chain($obj)
            ->also(fn (\stdClass $v) => $v->x = 1)
            ->into();

        $this->assertSame($obj, $result);
        $this->assertSame(1, $obj->x);
    }

    public function test_then_wraps_null_return(): void
    {
        $result = chain(42)
            ->then(fn (int $v) => null)
            ->into();

        $this->assertNull($result);
    }

    public function test_exception_propagation(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('chain error');

        chain(1)
            ->then(fn () => throw new \RuntimeException('chain error'))
            ->into();
    }

    public function test_also_between_then_preserves_chain(): void
    {
        $result = chain(10)
            ->then(fn (int $v) => $v + 5)
            ->also(fn (int $v) => $v)
            ->then(fn (int $v) => $v * 3)
            ->into();

        $this->assertSame(45, $result);
    }

    public function test_into_does_not_mutate_original(): void
    {
        $chain = chain(10);
        $result = $chain->into(fn (int $v) => $v + 1);

        $this->assertSame(11, $result);
        $this->assertSame(10, $chain->into());
    }

    public function test_chain_with_bool_value(): void
    {
        $result = chain(true)
            ->then(fn (bool $v) => !$v)
            ->into();

        $this->assertFalse($result);
    }
}
