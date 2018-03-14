<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

/**
 * @Annotation
 */
class Boolean implements TransformerInterface
{
    public function transform($origin)
    {
        return true;
    }

    public function reverse($transformed)
    {
        if ($transformed) {
            return '';
        }
    }
}
