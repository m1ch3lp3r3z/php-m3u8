<?php

namespace Chrisyue\PhpM3u8\M3u8\Builder;

/**
 * @Annotation
 */
class ObjectBuilder extends AbstractBuilder
{
    public function addValue($key, $value)
    {
        array_push($this->getResult()->$key, $value);
    }

    public function setValue($key, $value)
    {
        $this->getResult()->$key = $value;
    }

    public function getValue($key)
    {
        return $this->getResult()->$key;
    }
}
