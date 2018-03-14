<?php

namespace Chrisyue\PhpM3u8\M3u8\Lines;

use Chrisyue\PhpM3u8\M3u8\Transformer\TransformerInterface;
use Chrisyue\PhpM3u8\Stream\StreamInterface;

class Lines implements LinesInterface
{
    private $stream;

    private $transformer;

    public function __construct(StreamInterface $stream, TransformerInterface $transformer)
    {
        $this->stream = $stream;
        $this->transformer = $transformer;
    }

    public function read()
    {
        static $line;
        static $lineInfo;
        if ($this->stream->getLine() !== $line) {
            $line = $this->stream->getLine();
            $lineInfo = $this->transformer->transform($line);
        }

        return $lineInfo;
    }

    public function write(array $lineInfo)
    {
        $this->stream->putLine($this->transformer->reverse($lineInfo));
    }

    public function goNext()
    {
        $this->stream->goNext();

        if (!$this->stream->isValid()) {
            return;
        }

        $line = trim($this->stream->getLine());
        if (empty($line)) {
            $this->goNext();
        }
    }

    public function isValid()
    {
        return $this->stream->isValid();
    }
}
