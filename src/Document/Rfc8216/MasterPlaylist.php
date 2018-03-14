<?php

namespace Chrisyue\PhpM3u8\Document\Rfc8216;

use Chrisyue\PhpM3u8\M3u8\Core;
use Chrisyue\PhpM3u8\M3u8\PropertyReader\Reader;
use Chrisyue\PhpM3u8\M3u8\Transformer\AttributeList;

class MasterPlaylist extends AbstractPlaylist
{
    /**
     * @Core\StreamInf(tag=@Tag(name="#EXT-X-STREAM-INF", sequence=0, transformer=@AttributeList(class="Chrisyue\PhpM3u8\Document\Rfc8216\Tag\StreamInf", reader=@Reader)))
     */
    public $streamInfs = [];

    /**
     * @Core\Tag(name="#EXT-X-SESSION-KEY", sequence=0, transformer=@AttributeList(class="Chrisyue\PhpM3u8\Document\Rfc8216\Tag\Key", reader=@Reader))
     */
    public $sessionKeys = [];
}
