<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Lines;

use Chrisyue\PhpM3u8\M3u8\Lines\Lines;
use Chrisyue\PhpM3u8\M3u8\Transformer\TransformerInterface;
use Chrisyue\PhpM3u8\Stream\StreamInterface;
use PHPUnit\Framework\TestCase;

class LinesTest extends TestCase
{
    public function testGoNext()
    {
        $prophecy = $this->prophesize(StreamInterface::class);
        $prophecy->goNext()->shouldBeCalledTimes(1);
        $prophecy->isValid()->shouldBeCalledTimes(1)->willReturn(false);

        $lines = new Lines($prophecy->reveal(), $this->createMock(TransformerInterface::class));
        $lines->goNext();

        // if stream get an empty line, goNext should auto go next next.
        $prophecy = $this->prophesize(StreamInterface::class);
        $prophecy->goNext()->shouldBeCalledTimes(2);
        $prophecy->isValid()->shouldBeCalledTimes(2)->willReturn(true);
        $prophecy->getLine()->shouldBeCalledTimes(2)->willReturn(' ', '#TAG');

        $lines = new Lines($prophecy->reveal(), $this->createMock(TransformerInterface::class));
        $lines->goNext();
    }

    public function testIsValid()
    {
        $valid = (bool) rand(0, 1);

        $prophecy = $this->prophesize(StreamInterface::class);
        $prophecy->isValid()->shouldBeCalledTimes(1)->willReturn($valid);

        $lines = new Lines($prophecy->reveal(), $this->createMock(TransformerInterface::class));
        $this->assertSame($valid, $lines->isValid());
    }

    public function testRead()
    {
        $line = '#TAG';
        $transformed = ['tag' => '#TAG', 'value' => ''];

        $streamProphecy = $this->prophesize(StreamInterface::class);
        $streamProphecy->getLine()->willReturn($line);

        $transformerProphecy = $this->prophesize(TransformerInterface::class);
        $transformerProphecy->transform($line)->shouldBeCalledTimes(1)->willReturn($transformed);

        $lines = new Lines($streamProphecy->reveal(), $transformerProphecy->reveal());

        $this->assertSame($transformed, $lines->read());
        $this->assertSame($transformed, $lines->read()); // test read cache, should only transform once
    }

    public function testWrite()
    {
        $line = 'value';
        $transformed = ['value' => 'value'];

        $transformerProphecy = $this->prophesize(TransformerInterface::class);
        $transformerProphecy->reverse($transformed)->shouldBeCalledTimes(1)->willReturn($line);

        $streamProphecy = $this->prophesize(StreamInterface::class);
        $streamProphecy->putLine($line)->shouldBeCalled();

        $lines = new Lines($streamProphecy->reveal(), $transformerProphecy->reveal());
        $lines->write($transformed);
    }
}
