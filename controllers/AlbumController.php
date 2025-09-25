<?php
use models\Album;

function playlist(): void {
    $albums = Album::getAlbums();
    require_once ('views/album/playlist.php');
}
function show(int $id) {
    $album = Album::getAlbumById($id);
    $songs = Album::getSongsByAlbumId($id);
    require_once('views/album/show.php');
}
function add() {
    if (isset($_POST['albumTitle'], $_POST['albumAuthor'], $_POST['albumTrackNumber'], $_POST['albumEditor'])) {
        $title = $_POST['albumTitle'];
        $author = $_POST['albumAuthor'];
        $trackNumber = $_POST['albumTrackNumber'];
        $editor = $_POST['albumEditor'];
        $isAvailable = isset($_POST['isAvailable']);
        $fileId = null;

        if (!empty($title) && !empty($author) && !empty($trackNumber) && !empty($editor)) {
            try {
                Album::add($title, $author, $trackNumber, $editor, $isAvailable, $fileId);
                $success = "Album ajouté avec succès !";
            } catch (Exception $e) {
                $message = "Erreur : " . $e->getMessage();
            }
        } else {
            $message = "Veuillez remplir tous les champs.";
        }
    }
    require_once('views/album/form.php');
}

function edit($id) {
    $album = Album::getAlbumById($id);
    if (!$album) {
        header('Location: /album/playlist');
        exit;
    }
    if (isset($_POST['albumTitle'], $_POST['albumAuthor'], $_POST['albumTrackNumber'], $_POST['albumEditor'])) {
        $title = $_POST['albumTitle'];
        $author = $_POST['albumAuthor'];
        $trackNumber = $_POST['albumTrackNumber'];
        $editor = $_POST['albumEditor'];
        $isAvailable = isset($_POST['isAvailable']);
        $fileId = null;

        if (!empty($title) && !empty($author) && !empty($trackNumber) && !empty($editor)) {
            try {
                Album::update($id, $title, $author, $trackNumber, $editor, $isAvailable, $fileId);
                $success = "Album modifié avec succès !";
                header('Location: /album/show/' . $id);
                exit;
            } catch (Exception $e) {
                $message = "Erreur : " . $e->getMessage();
            }
        } else {
            $message = "Veuillez remplir tous les champs.";
        }
    }
    require_once('views/album/edit.php');
}

function delete(int $id): void {
    try {
        Album::delete($id);
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
    $albums = Album::getAlbums();
    require_once('views/album/playlist.php');
}
