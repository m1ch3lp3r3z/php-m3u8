PHP-M3U8 Built-in Supported Tags
================================

According to [RFC 8216](https://tools.ietf.org/html/rfc8216)

* Basic Tags
    - [x] EXTM3U
    - [x] EXT-X-VERSION
* Media Segment Tags
    - [x] EXTINF
    - [x] EXT-X-BYTERANGE
    - [x] EXT-X-DISCONTINUITY
    - [x] EXT-X-KEY
    - [ ] EXT-X-PROGRAM-DATE-TIME
    - [ ] EXT-X-MAP
    - [ ] EXT-X-DATERANGE
* Media Playlist Tags
    - [x] EXT-X-TARGETDURATION
    - [x] EXT-X-MEDIA-SEQUENCE
    - [x] EXT-X-DISCONTINUITY-SEQUENCE
    - [x] EXT-X-ENDLIST
    - [x] EXT-X-PLAYLIST-TYPE
    - [x] EXT-X-I-FRAMES-ONLY
* Master Playlist Tags
    - [ ] EXT-X-MEDIA
    - [x] EXT-X-STREAM-INF
    - [ ] EXT-X-I-FRAME-STREAM-INF
    - [ ] EXT-X-SESSION-DATA
    - [x] EXT-X-SESSION-KEY
* Media or Master Playlist Tags
    - [x] EXT-X-INDEPENDENT-SEGMENTS
    - [ ] EXT-X-START
