<?php

namespace Chrisyue\PhpM3u8\Document\Rfc8216\Tag;

use Chrisyue\PhpM3u8\M3u8\Core\Attribute;
use Chrisyue\PhpM3u8\M3u8\Transformer\AttributeString;
use Chrisyue\PhpM3u8\M3u8\Transformer\Integer;
use Chrisyue\PhpM3u8\M3u8\Transformer\Resolution;

class StreamInf
{
    /**
     * @Attribute(name="BANDWIDTH", transformer=@Integer)
     */
    public $bandwidth;

    /**
     * @Attribute(name="CODECS", transformer=@AttributeString)
     */
    public $codecs;

    /**
     * @Attribute(name="RESOLUTION", transformer=@Resolution)
     */
    public $resolution;

    public $uri;
}
