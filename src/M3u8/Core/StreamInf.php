<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

use Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface;

/**
 * @Annotation
 */
class StreamInf implements ChildCoreInterface
{
    /**
     * @var Chrisyue\PhpM3u8\M3u8\Core\Tag
     */
    public $tag;

    private $lines;

    public function setLines(LinesInterface $lines)
    {
        $this->lines = $lines;
        $this->tag->setLines($lines);

        return $this;
    }

    public function parse()
    {
        $result = $this->tag->parse();
        if (null === $result) {
            return;
        }

        $this->lines->goNext();
        $lineInfo = $this->lines->read();
        $result->uri = $lineInfo['value'];

        return $result;
    }

    public function dump($result)
    {
        $this->tag->dump($result);

        $this->lines->write(['value' => $result->uri]);
    }

    public function getSequence()
    {
        return $this->tag->getSequence();
    }
}
