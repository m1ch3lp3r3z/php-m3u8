<?php

namespace Chrisyue\PhpM3u8\Tests\Stream;

use Chrisyue\PhpM3u8\Stream\TextStream;
use PHPUnit\Framework\TestCase;

class TextStreamTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function test($text, $firstValid, $firstLine, $secondValid, $secondLine)
    {
        $stream = new TextStream($text);
        $this->assertSame($firstValid, $stream->isValid());
        $this->assertSame($firstLine, $stream->getLine());

        $stream->goNext();
        $this->assertSame($secondValid, $stream->isValid());
        $this->assertSame($secondLine, $stream->getLine());
    }

    public function dataProvider()
    {
        return [
            ["#TAG1\n#TAG2", true, '#TAG1', true, '#TAG2'],
            ['#TAG1', true, '#TAG1', false, false],
        ];
    }
}
