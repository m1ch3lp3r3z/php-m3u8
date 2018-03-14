<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Core;

use Chrisyue\PhpM3u8\M3u8\Core\Attribute;
use Chrisyue\PhpM3u8\M3u8\Transformer\TransformerInterface;
use PHPUnit\Framework\TestCase;

class AttributeTest extends TestCase
{
    public function testParse()
    {
        $origin = 'foo';
        $parsed = 'bar';

        $attr = new Attribute();
        $this->assertSame($origin, $attr->parse($origin));

        $transformerProphecy = $this->prophesize(TransformerInterface::class);
        $transformerProphecy->transform($origin)->shouldBeCalledTimes(1)->willReturn($parsed);

        $attr->transformer = $transformerProphecy->reveal();
        $this->assertSame($parsed, $attr->parse($origin));
    }

    public function testDump()
    {
        $origin = 'foo';
        $parsed = 'bar';

        $attr = new Attribute();
        $this->assertSame($parsed, $attr->dump($parsed));

        $transformerProphecy = $this->prophesize(TransformerInterface::class);
        $transformerProphecy->reverse($parsed)->shouldBeCalledTimes(1)->willReturn($origin);

        $attr->transformer = $transformerProphecy->reveal();
        $this->assertSame($origin, $attr->dump($parsed));
    }
}
