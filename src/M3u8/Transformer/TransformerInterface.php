<?php

namespace Chrisyue\PhpM3u8\M3u8\Transformer;

interface TransformerInterface
{
    public function transform($origin);

    public function reverse($transformed);
}
