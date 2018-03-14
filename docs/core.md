PHP-M3U8 Core
=============

The parsing process could be hard as the M3U8 protocol is complex.
To ease the procession, I've created some concepts, or utilities to
help.

Child Core
----------

A "Child Core" is a "Core", except that it is also "sequence awared",
as you can see in the `Chrisyue\PhpM3u8\M3u8\Core\ChildCoreInterface`,
it extends `Chrisyue\PhpM3u8\M3u8\Core\CoreInterface` and
`Chrisyue\PhpM3u8\M3u8\SequenceAwareInterface`.

So what exactly a "Child Core" is in human's words?

Take "Media Segment" as an example. In a valid M3U8 file, an "Media Playlist"
should contains several "Media Segment"s, so we could consider
a media segment is a **child** of media playlist. That's for documents.

For the cores, as a real M3U8 is complex, use only one single core is
very hard to parse a whole M3U8 playlist document (as the core parse playlist, I
will call it "Playlist Core"), so we could create some cores
inside the playlist core to help parsing some parts of the M3U8, like creating
"MediaSegmentCore" to try to parse the media segments. So "MediaSegmentCore"
is one of child cores of the playlist core. same situation between "Media
Segment" and "#EXTINF tag" (this time the tag core is a child core of media
segment core).

As a child part of a playlist (or media segment) is sequence awared, for example,
media segments must goes after `#EXT-X-VERSION`, and `#EXT-X-ENDLIST` must be the
last line of the document, we need a sequence to specific the child document's
position when dumping. Well, for parsing, the sequence could also to improve the
performance a little(we should not try to parse `#EXT-X-VERSION` when the media 
segments are parsing, so the child cores before media segment core could all be
skipped).

Parent Core
-----------

If there is a child, there should be a parent.

'Chrisyue\PhpM3u8\M3u8\Core\AbstractParentCore' is a built-in parent core,
its responsibility is simple: iterating the child cores to try to parse / dump.

However, it is not responsible to know where those children core come from,
that's why it is an abstract class and has an abstract method `getChildren`
to be implemented.

Also, it's not responsible to handle the parsed result, so, there is `intResult` method
to be implement, and there is a builder to be set. If you are familiar with "Builder Pattern",
you could consider the parent core as "Director".

Last, the sub class should tell this class that, if a line is parsed successfully,
whether it should continue to read and parse next line or not, that's the purpose
of the abstract `shouldParseNextLine` method.

And there's something should be mentioned, the parent core shouldn't try to let a child core
parse if the child core already parsed successfully before, **except** that the value the 
child core try to parse is an array, for example, media segments, or `#EXT-X-KEY`, or
`#EXT-X-STREAM-INF`.

So if you want to make a new Master Playlist parser, which trying to parse lines to
a simple array, instead of an object, you could try this:

```php
class MasterPlaylist extends Chrisyue\PhpM3u8\M3u8\Core\AbstractParentCore
{
    protected function getChildren()
    {
        $version = new Chrisyue\PhpM3u8\M3u8\Core\Tag();
        $version->name = '#EXT-X-VERSION';
        $version->sequence = 0;

        $sessionKeys = new Chrisyue\PhpM3u8\M3u8\Core\Tag();
        $sessionKeys->sequence = 0;
        // .... add more

        return compact('version', 'sessionKeys', ...);
    }

    protected function initResult()
    {
        return [
            'sessionKeys' => [], // make sure the sessionKeys is an array in the first place.
        ];
    }

    protected function shouldParseNextLine($result, $parsedSequence)
    {
        return true; // always true because the playlist core should try to parse all content.
    }
}

class ArrayBuilder extends Chrisyue\PhpM3u8\M3u8\Builder\AbstractBuilder
{
    public function setValue($key, $value)
    {
        $array = $this->getResult(); // `getResult` return a reference.
        $array[$key] = $value;
    }

    public function addValue($key, $value)
    {
        $array = $this->getResult();
        array_push($array[$key], $value);
    }

    public function getValue($key)
    {
        return $this->getResult()[$key];
    }
}
```

you could use it as:

```php
$core = new MediaPlaylist();
$core->builder = new ArrayBuilder();

$result = $core->setLines($lines)->parse();
```
