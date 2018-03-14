<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

use Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface;

abstract class AbstractCore implements CoreInterface
{
    private $lines;

    public function setLines(LinesInterface $lines)
    {
        $this->lines = $lines;

        return $this;
    }

    protected function getLines()
    {
        return $this->lines;
    }
}
