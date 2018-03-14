<?php

namespace Chrisyue\PhpM3u8\Tests\Stream;

use Chrisyue\PhpM3u8\Stream\FileStream;
use PHPUnit\Framework\TestCase;

class FileStreamTest extends TestCase
{
    public function testNext()
    {
        $prophecy = $this->prophesize(\SplFileObject::class);
        $prophecy->next()->shouldBeCalledTimes(1);

        $stream = new FileStream($prophecy->reveal());
        $stream->goNext();
    }

    public function testValid()
    {
        $valid = (bool) rand(0, 1);
        $prophecy = $this->prophesize(\SplFileObject::class);
        $prophecy->valid()->shouldBeCalledTimes(1)->willReturn($valid);

        $stream = new FileStream($prophecy->reveal());
        $this->assertSame($valid, $stream->isValid());
    }

    public function testGetLine()
    {
        $line = 'https://foo.bar/baz';
        $prophecy = $this->prophesize(\SplFileObject::class);
        $prophecy->current()->shouldBeCalled()->willReturn($line);

        $stream = new FileStream($prophecy->reveal());
        $this->assertSame($line, $stream->getLine());
    }
}
