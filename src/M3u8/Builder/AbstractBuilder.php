<?php

namespace Chrisyue\PhpM3u8\M3u8\Builder;

abstract class AbstractBuilder implements BuilderInterface
{
    private $result;

    public function setResult($result)
    {
        $this->result = $result;

        return $this->result;
    }

    public function &getResult()
    {
        return $this->result;
    }
}
