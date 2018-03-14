<?php

namespace Chrisyue\PhpM3u8\M3u8;

trait SequenceAwareTrait
{
    /**
     * @var int
     */
    public $sequence;

    public function getSequence()
    {
        return $this->sequence;
    }
}
