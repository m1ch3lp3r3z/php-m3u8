<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

/**
 * @Annotation
 */
class AttributeString implements TransformerInterface
{
    public function transform($origin)
    {
        return trim($origin, '"');
    }

    public function reverse($string)
    {
        return sprintf('"%s"', $string);
    }
}
