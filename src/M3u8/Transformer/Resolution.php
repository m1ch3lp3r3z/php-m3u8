<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

/**
 * @Annotation
 */
class Resolution implements TransformerInterface
{
    public function transform($origin)
    {
        list($width, $height) = explode('x', $origin);

        return compact('width', 'height');
    }

    public function reverse($transformed)
    {
        return sprintf('%dx%d', $transformed['width'], $transformed['height']);
    }
}
