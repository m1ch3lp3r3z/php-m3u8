<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

use Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface;

interface CoreInterface
{
    /**
     * @param Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface $lines
     *
     * @return self
     */
    public function setLines(LinesInterface $lines);

    /**
     * @return mixed
     */
    public function parse();

    /**
     * @param mixed $result
     */
    public function dump($result);
}
