<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

abstract class AbstractAnnotationReadable extends AbstractParentCore
{
    private $children;

    /**
     * @var Chrisyue\PhpM3u8\M3u8\PropertyReader\PropertyReaderInterface
     */
    public $reader;

    /**
     * @var string
     */
    public $class;

    protected function getChildren()
    {
        if (null === $this->children) {
            $this->children = $this->reader->read($this->class, ChildCoreInterface::class);
        }

        return $this->children;
    }

    protected function initResult()
    {
        return new $this->class();
    }
}
