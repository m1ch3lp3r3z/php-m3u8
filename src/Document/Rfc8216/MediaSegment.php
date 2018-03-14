<?php

namespace Chrisyue\PhpM3u8\Document\Rfc8216;

use Chrisyue\PhpM3u8\M3u8\Core;
use Chrisyue\PhpM3u8\M3u8\PropertyReader\Reader;
use Chrisyue\PhpM3u8\M3u8\Transformer\AttributeList;
use Chrisyue\PhpM3u8\M3u8\Transformer\Boolean;
use Chrisyue\PhpM3u8\M3u8\Transformer\Byterange;
use Chrisyue\PhpM3u8\M3u8\Transformer\Inf;

class MediaSegment
{
    /**
     * @Core\Tag(name="#EXT-X-BYTERANGE", sequence=0, transformer=@Byterange)
     */
    public $byterange;

    /**
     * @Core\Tag(name="#EXT-X-DISCONTINUITY", sequence=0, transformer=@Boolean)
     */
    public $discontinuity;

    /**
     * @Core\Tag(name="#EXT-X-KEY", sequence=0, transformer=@AttributeList(class="Chrisyue\PhpM3u8\Document\Rfc8216\Tag\Key", reader=@Reader))
     */
    public $keys = [];

    /**
     * @Core\Tag(name="#EXTINF", sequence=0, transformer=@Inf)
     */
    public $inf;

    /**
     * @Core\MediaSegmentUri(sequence=1)
     */
    public $uri;
}
