<?php

namespace Chrisyue\PhpM3u8\Document\Rfc8216\Tag;

use Chrisyue\PhpM3u8\M3u8\Core\Attribute;
use Chrisyue\PhpM3u8\M3u8\Transformer\AttributeString;

class Key
{
    /**
     * @Attribute(name="METHOD")
     */
    public $method;

    /**
     * @Attribute(name="URI", transformer=@AttributeString)
     */
    public $uri;

    /**
     * @Attribute(name="IV")
     */
    public $iv;
}
