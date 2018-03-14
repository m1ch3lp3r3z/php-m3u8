<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

use Chrisyue\PhpM3u8\M3u8\SequenceAwareTrait;

/**
 * @Annotation
 */
class MediaSegment extends AbstractAnnotationReadable implements ChildCoreInterface
{
    use SequenceAwareTrait;

    protected function shouldParseNextLine($result)
    {
        return null !== $result && null === $result->uri;
    }
}
