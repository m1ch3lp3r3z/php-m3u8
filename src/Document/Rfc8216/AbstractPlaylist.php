<?php

namespace Chrisyue\PhpM3u8\Document\Rfc8216;

use Chrisyue\PhpM3u8\M3u8\Core;
use Chrisyue\PhpM3u8\M3u8\Transformer\Boolean;
use Chrisyue\PhpM3u8\M3u8\Transformer\Integer;

abstract class AbstractPlaylist
{
    /**
     * @Core\Tag(name="#EXT-X-VERSION", sequence=0, transformer=@Integer)
     */
    public $version;

    /**
     * @Core\Tag(name="#EXT-X-INDEPENDENT-SEGMENTS", sequence=0, transformer=@Boolean)
     */
    public $independentSegments;
}
