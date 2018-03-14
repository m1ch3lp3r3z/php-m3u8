<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

use Chrisyue\PhpM3u8\Document\Rfc8216\Tag;

/**
 * @Annotation
 */
class Inf implements TransformerInterface
{
    public function transform($origin)
    {
        $inf = new Tag\Inf();
        list($duration, $inf->title) = explode(',', $origin, 2);

        $inf->duration = +$duration;

        return $inf;
    }

    public function reverse($inf)
    {
        return sprintf('%s,%s', $inf->duration, $inf->title);
    }
}
