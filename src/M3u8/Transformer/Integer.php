<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

/**
 * @Annotation
 */
class Integer implements TransformerInterface
{
    public function transform($origin)
    {
        return (int) $origin;
    }

    public function reverse($transformed)
    {
        return sprintf('%d', $transformed);
    }
}
