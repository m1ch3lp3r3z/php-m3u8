<?php

namespace Chrisyue\PhpM3u8\Stream;

class FileStream implements StreamInterface
{
    private $file;

    public function __construct(\SplFileObject $file)
    {
        $this->file = $file;
    }

    public function goNext()
    {
        $this->file->next();
    }

    public function isValid()
    {
        return $this->file->valid();
    }

    public function getLine()
    {
        return trim($this->file->current());
    }

    public function putLine($line)
    {
        $this->file->fwrite($line."\n");
    }
}
