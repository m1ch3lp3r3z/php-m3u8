<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

use Chrisyue\PhpM3u8\M3u8\Attribute\AttributeInterface;

/**
 * @Annotation
 */
class AttributeList extends AbstractAttributeList
{
    /**
     * @var Chrisyue\PhpM3u8\M3u8\PropertyReader\PropertyReaderInterface
     */
    public $reader;

    /**
     * @var string
     */
    public $class;

    private $m3u8s;

    protected function getAttributeM3u8s()
    {
        if (null === $this->m3u8s) {
            $this->m3u8s = $this->reader->read($this->class, AttributeInterface::class);
        }

        return $this->m3u8s;
    }

    protected function initResult()
    {
        return new $this->class();
    }
}
