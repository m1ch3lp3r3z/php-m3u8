PHP-M3U8 Advanced Usage
=======================

If you look inside the `Chrisyue\PhpM3u8\M3u8\PlaylistFacade` class,
you'll notice that this class does several tasks while parsing / dumping:

1. It creates an object called "Core".
2. It creates an object called "Lines".
3. It inject "Lines" into "Core" by "setLines" method before parsing / dumping;
4. The "Core" now can read content from "Lines", and parses and returns the parsed "Document".
   On the opposite, the "Core" dump the "Document" back to content, and write back to "Lines".

As you can see, there are 3 important parts works together: "Core", "Lines", and the "Document".

Lines
-----

"Lines" represents a stream readable object.

The "Lines" reads a text stream line by line.  Actually the "Lines" will pre-parse a line
into an array like `['tag' => $tag, 'value' => $value]` as "line information".

Of course, on the opposite, "Line" can pre-transform the "line information" back to a line,
and write it back to a text stream.

You could check the `Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface` to find out how to manipulate a
"Lines". Its APIs could explain itself enough.

There is a built-in "Lines" which is `Chrisyue\PhpM3u8\M3u8\Lines\Lines`. It takes 2 other dependencies:
`Chrisyue\PhpM3u8\Stream\StreamInterface` as stream
and `Chrisyue\PhpM3u8\M3u8\Transformer\TransformerInterface` as line transformer.

The stream's responsibility is to read or write lines from/to a stream. And the transformer's
responsibility is to transform the line into "line information" data and reverse. 
The `Chrisyue\PhpM3u8\M3u8\Lines\Lines` class just combine them to work together.

So if you want to get "line information" other than the built-in "FileStream" or "TextStream",
you could provide your own stream object and inject it into `Chrisyue\PhpM3u8\M3u8\Lines\Lines`.
Or even you could have your own "Lines" by implementing the `Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface`.

Document
--------

"Document" is a model represent a M3u8 file, or part of it.

When I say "a part of it", I mean like a media segment in media playlist, or an EXTINF data in media
segment, or an attribute value in a Attribute-List tag.

"Document" has no interfaces, actually it event could be something other than class, like an array.

There is built-in documents too, based on the [Rfc8216](built_in_supported_tags.md).

If the built-in documents are not suitable for your needs, feel free to change them, or create your
own documents.

Core
----

"Core" is the one who does the parsing / dumping job.

If an object could convert a "Lines" to a document, and vice versa, it is a "Core".

You can learn more about it in the [next chapter]('core.md')

Put Things Work Together
------------------------

So how can the 3 parts work together? Let's create the most simple implementation as a demo,
reading the M3u8 stream directly from shell and parse, or print the dumped result to shell.
And let the parsed document be simple enough too, an array.

Moreover, supports and only supports the format of '#TAG:VALUE', event if it's not a valid M3u8 tag.

First, let's create the "Lines" and "Core".

```php
class StdioLines implements Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface
{
    private $line;

    public function goNext()
    {
        $this->line = trim(fgets(STDIN));
    }

    public function isValid()
    {
        // the stream should end when nothing is input.
        return !empty($this->line);
    }

    public function read()
    {
        if (null === $this->line) {
            $this->goNext();
        }

        list($tag, $value) = explode(':', $this->line);

        return compact('tag', 'value');
    }

    public function write(array $lineInfo)
    {
        echo sprintf('%s:%s', $lineInfo['tag'], $lineInfo['value']), PHP_EOL;
    }
}

class Core implements Chrisyue\PhpM3u8\M3u8\Core\CoreInterface
{
    private $lines;

    public function setLines(Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface $lines)
    {
        $this->lines = $lines;

        return $this;
    }

    public function parse()
    {
        $result = [];

        do {
            $lineInfo = $this->lines->read();
            $result[$lineInfo['tag']] = $lineInfo['value'];

            $this->lines->goNext();
        } while ($this->lines->isValid());

        return $result;
    }

    public function dump($result)
    {
        foreach ($result as $lineInfo) {
            $this->lines->write($lineInfo);
        }
    }
}
```

Now you could try them:

```php
$core = new Core();
$lines = new StdioLines();

$core->setLines($lines);
var_export($core->parse());

// or dump a result
// $core->dump([['tag' => '#FOO', 'value' => 'foo'], ['tag' => '#BAR', 'value' => 'bar']]);
```

Thanks to the `Chrisyue\PhpM3u8\M3u8\Lines\LinesInterface` and the `Chrisyue\PhpM3u8\M3u8\Core\CoreInterface`,
you could even use them with the built-in "Lines" and "Cores" interoperably.

However, a real M3U8 parser / dumper couldn't be that simple.
Continue to [next chapter](core.md) to figure out how to create a real
useful parser / dumper.
