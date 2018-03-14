<?php

namespace Chrisyue\PhpM3u8\Tests\M3u8\Transformer;

use Chrisyue\PhpM3u8\M3u8\Transformer\Resolution;
use PHPUnit\Framework\TestCase;

class ResolutionTest extends TestCase
{
    public function testTransform()
    {
        $transformer = new Resolution();

        $this->assertSame(['width' => '1920', 'height' => '1080'], $transformer->transform('1920x1080'));
    }

    public function testReverse()
    {
        $transformer = new Resolution();

        $this->assertSame('1280x800', $transformer->reverse(['width' => '1280', 'height' => '800']));
    }
}
