<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Core;

use Chrisyue\PhpM3u8\M3u8\Core\Tag;
use Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface;
use Chrisyue\PhpM3u8\M3u8\Transformer\TransformerInterface;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    public function testSequence()
    {
        $sequence = rand();
        $tag = new Tag();
        $tag->sequence = $sequence;

        $this->assertSame($sequence, $tag->getSequence());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testParseWithTransformer(array $lineInfo, $tagName, $transformCalledTimes, $transformed)
    {
        $linesProphecy = $this->prophesize(LinesInterface::class);
        $linesProphecy->read()->shouldBeCalledTimes(1)->willReturn($lineInfo);

        $transformerProphecy = $this->prophesize(TransformerInterface::class);
        $transformerProphecy->transform($lineInfo['value'])->shouldBeCalledTimes($transformCalledTimes)->willReturn($transformed);

        $tag = new Tag();
        $tag->name = $tagName;
        $tag->transformer = $transformerProphecy->reveal();
        $tag->setLines($linesProphecy->reveal());

        $this->assertSame($transformed, $tag->parse());
    }

    public function testParse()
    {
        $name = '#TAG';
        $value = 'value';

        $linesProphecy = $this->prophesize(LinesInterface::class);
        $linesProphecy->read()->shouldBeCalledTimes(1)->willReturn(['tag' => $name, 'value' => $value]);

        $tag = new Tag();
        $tag->name = $name;
        $tag->setLines($linesProphecy->reveal());

        $this->assertSame($value, $tag->parse());
    }

    public function dataProvider()
    {
        return [
            [['value' => ''], '#TAG', 0, null],
            [['tag' => '#TAG', 'value' => ''], '#OTHER', 0, null],
            [['tag' => '#TAG', 'value' => 'value'], '#TAG', 1, 'transformed value'],
        ];
    }
}
