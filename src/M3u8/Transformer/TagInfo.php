<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

class TagInfo implements TransformerInterface
{
    public function transform($line)
    {
        $line = trim($line);
        if (empty($line)) {
            return;
        }

        if ('#' !== $line[0]) {
            return ['value' => $line];
        }

        if (strlen($line) < 2) {
            return;
        }

        list($tag, $value) = array_pad(explode(':', $line, 2), 2, '');

        return compact('tag', 'value');
    }

    public function reverse($lineInfo)
    {
        if (empty($lineInfo['tag'])) {
            return $lineInfo['value'];
        }

        if (empty($lineInfo['value'])) {
            return $lineInfo['tag'];
        }

        return sprintf('%s:%s', $lineInfo['tag'], $lineInfo['value']);
    }
}
