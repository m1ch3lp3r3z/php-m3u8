<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

use Chrisyue\PhpM3u8\M3u8\SequenceAwareTrait;
use Chrisyue\PhpM3u8\M3u8\Transformer\TransformerInterface;

/**
 * @Annotation
 */
class Tag extends AbstractCore implements ChildCoreInterface
{
    use SequenceAwareTrait;

    /**
     * @var string
     */
    public $name;

    /**
     * @var Chrisyue\PhpM3u8\M3u8\Transformer\TransformerInterface
     */
    public $transformer;

    public function parse()
    {
        $lineInfo = $this->getLines()->read();
        if (!isset($lineInfo['tag']) || $this->name !== $lineInfo['tag']) {
            return;
        }

        if ($this->transformer instanceof TransformerInterface) {
            $lineInfo['value'] = $this->transformer->transform($lineInfo['value']);
        }

        return $lineInfo['value'];
    }

    public function dump($value)
    {
        if ($this->transformer instanceof TransformerInterface) {
            $value = $this->transformer->reverse($value);
        }

        $this->getLines()->write(['tag' => $this->name, 'value' => $value]);

        return $this;
    }
}
