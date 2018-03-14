<?php

namespace Chrisyue\PhpM3u8\Stream;

class TextStream implements StreamInterface
{
    private $lines;

    public function __construct($text = '')
    {
        $this->lines = explode("\n", $text);
    }

    public function goNext()
    {
        next($this->lines);
    }

    public function isValid()
    {
        return false !== current($this->lines);
    }

    public function getLine()
    {
        return current($this->lines);
    }

    public function putLine($line)
    {
        $this->lines[] = $line;
    }

    public function __toString()
    {
        return implode("\n", $this->lines);
    }
}
