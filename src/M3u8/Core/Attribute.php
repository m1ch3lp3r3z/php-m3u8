<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

use Chrisyue\PhpM3u8\M3u8\Transformer\TransformerInterface;

/**
 * @Annotation
 */
class Attribute implements AttributeInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var Chrisyue\PhpM3u8\M3u8\Transformer\TransformerInterface
     */
    public $transformer;

    public function parse($origin)
    {
        if (!$this->transformer instanceof TransformerInterface) {
            return $origin;
        }

        return $this->transformer->transform($origin);
    }

    public function dump($parsed)
    {
        if (!$this->transformer instanceof TransformerInterface) {
            return $parsed;
        }

        return $this->transformer->reverse($parsed);
    }

    public function getName()
    {
        return $this->name;
    }
}
