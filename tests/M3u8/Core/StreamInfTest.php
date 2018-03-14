<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Core;

use Chrisyue\PhpM3u8\Document\Rfc8216;
use Chrisyue\PhpM3u8\M3u8\Core\StreamInf;
use Chrisyue\PhpM3u8\M3u8\Core\Tag;
use Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface;
use PHPUnit\Framework\TestCase;

class StreamInfTest extends TestCase
{
    public function testParse()
    {
        // case 1: stream-inf tag parsed
        $uri = 'https://path/to/media';
        $streamInf = new Rfc8216\Tag\StreamInf();

        $linesProphecy = $this->prophesize(LinesInterface::class);
        $linesProphecy->goNext()->shouldBeCalledTimes(1);
        // in StreamInf's read method, the LinesInterface::read should be called 1 time;
        $linesProphecy->read()->shouldBeCalledTimes(1)->willReturn(['value' => $uri]);

        $tagProphecy = $this->prophesize(Tag::class);
        $tagProphecy->setLines($linesProphecy->reveal())->shouldBeCalledTimes(1);
        $tagProphecy->parse()->shouldBeCalledTimes(1)->willReturn(clone $streamInf);

        $core = new StreamInf();
        $core->tag = $tagProphecy->reveal();
        $core->setLines($linesProphecy->reveal());

        $streamInf->uri = $uri;
        $this->assertEquals($streamInf, $core->parse());

        // case 2: non stream-inf tag parsed
        $linesProphecy = $this->prophesize(LinesInterface::class);
        $linesProphecy->goNext()->shouldBeCalledTimes(0);
        $linesProphecy->read()->shouldBeCalledTimes(0);

        $tagProphecy = $this->prophesize(Tag::class);
        $tagProphecy->setLines($linesProphecy->reveal())->shouldBeCalledTimes(1);
        $tagProphecy->parse()->shouldBeCalledTimes(1)->willReturn(null);

        $core = new StreamInf();
        $core->tag = $tagProphecy->reveal();
        $core->setLines($linesProphecy->reveal());

        $this->assertNull($core->parse());
    }

    public function testDump()
    {
        $uri = 'https://path/to/media';
        $streamInf = new Rfc8216\Tag\StreamInf();
        $streamInf->uri = $uri;

        $linesProphecy = $this->prophesize(LinesInterface::class);
        $linesProphecy->write(['value' => $uri])->shouldBeCalledTimes(1);

        $tagProphecy = $this->prophesize(Tag::class);
        $tagProphecy->setLines($linesProphecy->reveal())->shouldBeCalledTimes(1);
        $tagProphecy->dump($streamInf)->shouldBeCalledTimes(1);

        $core = new StreamInf();
        $core->tag = $tagProphecy->reveal();
        $core->setLines($linesProphecy->reveal());

        $core->dump($streamInf);
    }
}
