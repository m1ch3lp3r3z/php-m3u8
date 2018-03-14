<?php

namespace Chrisyue\PhpM3u8\M3u8\Builder;

interface BuilderInterface
{
    public function setResult($result);

    public function addValue($key, $value);

    public function setValue($key, $value);

    public function getValue($key);

    public function getResult();
}
