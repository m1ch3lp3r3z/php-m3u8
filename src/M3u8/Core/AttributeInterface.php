<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

interface AttributeInterface
{
    public function getName();

    public function parse($origin);

    public function dump($parsed);
}
