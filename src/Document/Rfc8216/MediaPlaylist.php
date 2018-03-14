<?php

namespace Chrisyue\PhpM3u8\Document\Rfc8216;

use Chrisyue\PhpM3u8\M3u8\Builder\ObjectBuilder;
use Chrisyue\PhpM3u8\M3u8\Core;
use Chrisyue\PhpM3u8\M3u8\PropertyReader\Reader;
use Chrisyue\PhpM3u8\M3u8\Transformer\Boolean;
use Chrisyue\PhpM3u8\M3u8\Transformer\Integer;

class MediaPlaylist extends AbstractPlaylist
{
    /**
     * @Core\Tag(name="#EXT-X-TARGETDURATION", sequence=0, transformer=@Integer)
     */
    public $targetduration;

    /**
     * @Core\Tag(name="#EXT-X-MEDIA-SEQUENCE", sequence=0, transformer=@Integer)
     */
    public $mediaSequence;

    /**
     * @Core\Tag(name="#EXT-X-DISCONTINUITY-SEQUENCE", sequence=0, transformer=@Integer)
     */
    public $discontinuitySequence;

    /**
     * @Core\Tag(name="#EXT-X-PLAYLIST-TYPE", sequence=0)
     */
    public $playlistType;

    /**
     * @Core\Tag(name="#EXT-X-I-FRAMES-ONLY", sequence=0, transformer=@Boolean)
     */
    public $iFramesOnly;

    /**
     * @Core\MediaSegment(class="Chrisyue\PhpM3u8\Document\Rfc8216\MediaSegment", sequence=1, reader=@Reader, builder=@ObjectBuilder)
     */
    public $mediaSegments = [];

    /**
     * @Core\Tag(name="#EXT-X-ENDLIST", sequence=2, transformer=@Boolean)
     */
    public $endlist;
}
