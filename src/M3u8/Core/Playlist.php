<?php

namespace Chrisyue\PhpM3u8\M3u8\Core;

class Playlist extends AbstractAnnotationReadable
{
    public function dump($result)
    {
        $this->getLines()->write(['tag' => '#EXTM3U']);

        parent::dump($result);
    }

    protected function shouldParseNextLine($result)
    {
        return true;
    }
}
