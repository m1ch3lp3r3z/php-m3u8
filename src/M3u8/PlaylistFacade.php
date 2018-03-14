<?php

namespace Chrisyue\PhpM3u8\M3u8;

use Chrisyue\PhpM3u8\M3u8\Builder\ObjectBuilder;
use Chrisyue\PhpM3u8\M3u8\Core\Playlist;
use Chrisyue\PhpM3u8\M3u8\Lines\Lines;
use Chrisyue\PhpM3u8\M3u8\PropertyReader\Reader;
use Chrisyue\PhpM3u8\M3u8\Transformer\TagInfo;
use Chrisyue\PhpM3u8\Stream\FileStream;
use Chrisyue\PhpM3u8\Stream\TextStream;

class PlaylistFacade
{
    private $core;

    public function __construct($class)
    {
        $this->core = new Playlist();
        $this->core->class = $class;
        $this->core->reader = new Reader();
        $this->core->builder = new ObjectBuilder();
    }

    public function parse($text)
    {
        $lines = new Lines(new TextStream($text), new TagInfo());

        return $this->core->setLines($lines)->parse();
    }

    public function dump($playlist)
    {
        $this->checkPlaylist($playlist);

        $text = new TextStream();
        $lines = new Lines($text, new TagInfo());

        $this->core->setLines($lines);
        $this->core->dump($playlist);

        return $text;
    }

    public function parseFromFile($path)
    {
        $lines = new Lines(new FileStream(new \SplFileObject($path)), new TagInfo());

        return $this->core->setLines($lines)->parse();
    }

    public function dumpToFile($playlist, $path)
    {
        $this->checkPlaylist($playlist);

        $file = new \SplFileObject($path);
        $lines = new Lines(new FileStream($file), new TagInfo());

        $this->core->setLines($lines);
        $this->core->dump($playlist);

        return $file;
    }

    private function checkPlaylist($playlist)
    {
        if (!$playlist instanceof $this->core->class) {
            throw new \InvalidArgumentException('Only playlist of class `%s` is supported, `%s` is given', $this->core->class, get_class($playlist));
        }
    }
}
