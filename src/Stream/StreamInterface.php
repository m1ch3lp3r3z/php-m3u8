<?php

namespace Chrisyue\PhpM3u8\Stream;

interface StreamInterface
{
    public function goNext();

    public function isValid();

    public function getLine();

    public function putLine($line);
}
