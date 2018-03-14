<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Transformer;

use Chrisyue\PhpM3u8\M3u8\Transformer\Boolean;
use PHPUnit\Framework\TestCase;

class BoolTest extends TestCase
{
    public function testTransform()
    {
        $transformer = new Boolean();

        $this->assertTrue($transformer->transform(''));
    }

    public function testReverse()
    {
        $transformer = new Boolean();

        $this->assertSame('', $transformer->reverse(true));
        $this->assertNull($transformer->reverse(false));
    }
}
