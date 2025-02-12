<?php

namespace Luggsoft\Chainable;

use PHPUnit\Framework\TestCase;

class ChainableInterfaceTest extends TestCase
{
    public function testThenInto(): void
    {
        $result = chain(123)
            ->then(fn(int $v) => $v + 1)
            ->then(fn(int $v) => $v * 2)
            ->into();

        $this->assertEquals(248, $result);
    }

    public function testThenAlsoInto(): void
    {
        $refers = 0;
        $result = chain(123)
            ->then(fn(int $v) => $v + 1)
            ->also(function (int $v) use (&$refers) {
                $refers = $v;
            })
            ->then(fn(int $v) => $v * 2)
            ->into();
        
        $this->assertEquals(248, $result);
        $this->assertEquals(124, $refers);
    }
}
