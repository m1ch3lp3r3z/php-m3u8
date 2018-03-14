<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Transformer;

use Chrisyue\PhpM3u8\M3u8\Transformer\Integer;
use PHPUnit\Framework\TestCase;

class IntegerTest extends TestCase
{
    public function testTransform()
    {
        $transformer = new Integer();

        $this->assertSame(1, $transformer->transform('1'));
    }

    public function testReverse()
    {
        $transformer = new Integer();

        $this->assertSame('0', $transformer->reverse(0));
    }
}
