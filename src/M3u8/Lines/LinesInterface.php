<?php

namespace Chrisyue\PhpM3u8\M3u8\Lines;

interface LinesInterface
{
    public function goNext();

    public function isValid();

    public function read();

    public function write(array $lineInfo);
}
