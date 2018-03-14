<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

use Chrisyue\PhpM3u8\Document\Rfc8216\Tag;

/**
 * @Annotation
 */
class Byterange implements TransformerInterface
{
    public function transform($origin)
    {
        $byterange = new Tag\Byterange();
        list($length, $offset) = array_pad(explode('@', $origin, 2), 2, null);

        $byterange->length = (int) $length;
        if (null !== $offset) {
            $byterange->offset = (int) $offset;
        }

        return $byterange;
    }

    public function reverse($byterange)
    {
        if (empty($byterange->offset)) {
            return sprintf('%d', $byterange->length);
        }

        return sprintf('%d@%d', $byterange->length, $byterange->offset);
    }
}
