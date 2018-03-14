<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Transformer;

use Chrisyue\PhpM3u8\Document\Rfc8216\Tag;
use Chrisyue\PhpM3u8\M3u8\Transformer\Inf;
use PHPUnit\Framework\TestCase;

class InfTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testTransform($origin, $transformed)
    {
        $transformer = new Inf();

        $this->assertEquals($transformed, $transformer->transform($origin));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testReverse($origin, $transformed)
    {
        $transformer = new Inf();

        $this->assertSame($origin, $transformer->reverse($transformed));
    }

    public function dataProvider()
    {
        $data = [];

        $origin = '100,';
        $transformed = new Tag\Inf();
        $transformed->duration = 100;

        $data[] = [$origin, $transformed];

        $origin = '200.123,hello world';
        $transformed = new Tag\Inf();
        $transformed->duration = 200.123;
        $transformed->title = 'hello world';

        $data[] = [$origin, $transformed];

        return $data;
    }
}
