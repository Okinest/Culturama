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
        $filePath = null;

        if (isset($_FILES['albumImage']) && $_FILES['albumImage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/images/albums/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['albumImage']['name']);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['albumImage']['tmp_name'], $targetPath)) {
                $filePath = $targetPath;
            }
        }

        if (!empty($title) && !empty($author) && !empty($trackNumber) && !empty($editor)) {
            try {
                Album::add($title, $author, $trackNumber, $editor, $isAvailable, $filePath);
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
        $filePath = null;

        if (isset($_FILES['albumImage']) && $_FILES['albumImage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/images/albums/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['albumImage']['name']);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['albumImage']['tmp_name'], $targetPath)) {
                $filePath = $targetPath;
            }
        }
        if (!empty($title) && !empty($author) && !empty($trackNumber) && !empty($editor)) {
            try {
                Album::update($id, $title, $author, $trackNumber, $editor, $isAvailable, $filePath);
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
function loan_return($id) {
    $album = Album::getAlbumById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'loan' && $album['isAvailable']) {
            Album::update($id, $album['title'], $album['author'], $album['trackNumber'], $album['editor'], false, $album['file_path']);
        } elseif ($_POST['action'] === 'return' && !$album['isAvailable']) {
            Album::update($id, $album['title'], $album['author'], $album['trackNumber'], $album['editor'], true, $album['file_path']);
        }
    }
    header('Location: /album/show/' . $id);
    exit;
}

