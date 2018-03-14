<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Transformer;

use Chrisyue\PhpM3u8\M3u8\Transformer\TagInfo;
use PHPUnit\Framework\TestCase;

class TagInfoTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testTransform($origin, $transformed)
    {
        $transformer = new TagInfo();

        $this->assertSame($transformed, $transformer->transform($origin));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testReverse($origin, $transformed)
    {
        $transformer = new TagInfo();

        $this->assertSame($origin, $transformer->reverse($transformed));
    }

    public function dataProvider()
    {
        return [
            ['#TAG:VALUE', ['tag' => '#TAG', 'value' => 'VALUE']],
            ['#TAG', ['tag' => '#TAG', 'value' => '']],
            ['VALUE', ['value' => 'VALUE']],
        ];
    }
}
