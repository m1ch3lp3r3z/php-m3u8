<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

/**
 * @Annotation
 */
class MediaSegmentUri extends AbstractCore implements ChildCoreInterface
{
    /**
     * @var int
     */
    public $sequence;

    public function parse()
    {
        $lineInfo = $this->getLines()->read();
        if (isset($lineInfo['tag'])) {
            return;
        }

        return $lineInfo['value'];
    }

    public function dump($value)
    {
        $this->getLines()->write(['value' => $value]);

        return $this;
    }

    public function getSequence()
    {
        return $this->sequence;
    }
}
