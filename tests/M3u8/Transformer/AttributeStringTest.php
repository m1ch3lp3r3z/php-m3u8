<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Transformer;

use Chrisyue\PhpM3u8\M3u8\Transformer\AttributeString;
use PHPUnit\Framework\TestCase;

class AttributeStringTest extends TestCase
{
    public function testTransform()
    {
        $transformer = new AttributeString();

        $this->assertSame('string', $transformer->transform('"string"'));
    }

    public function testReverse()
    {
        $transformer = new AttributeString();

        $this->assertSame('"string"', $transformer->reverse('string'));
    }
}
