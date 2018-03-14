<?php

use Chrisyue\PhpM3u8\Document\Rfc8216\MediaPlaylist;
use Chrisyue\PhpM3u8\M3u8\PlaylistFacade;

require 'vendor/autoload.php';

$phpM3u8 = new PlaylistFacade(MediaPlaylist::class);
$result = $phpM3u8->parseFromFile('test.m3u8');

var_export($result);
