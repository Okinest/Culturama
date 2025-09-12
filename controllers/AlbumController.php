<?php
use models\Album;

function playlist(): void {
    $albums = Album::getAlbums();
    require_once ('views/album/playlist.php');
}
