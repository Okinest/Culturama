<?php

namespace models;

use models\database\Database;
use PDO;
use PDOException;

class Album extends Media
{
    private int $trackNumber;
    private string $editor;
    private array $songs = [];
    public function __construct(string $title, string $author, int $trackNumber, string $editor, bool $isAvailable = true)
    {
        parent::__construct($title, $author, $isAvailable);
        $this->trackNumber = $trackNumber;
        $this->editor = $editor;
    }

    public function getTrackNumber(): int
    {
        return $this->trackNumber;
    }

    public function setTrackNumber(int $trackNumber): void
    {
        $this->trackNumber = $trackNumber;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }

    public function setEditor(string $editor): void
    {
        $this->editor = $editor;
    }
    public function addSong(Song $song): void
    {
        $this->songs[] = $song;
    }

    public function getSongs(): array
    {
        return $this->songs;
    }

    public static function getAlbums()
    {
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT albums.*, files.path AS image
                                        FROM albums
                                        LEFT JOIN files ON albums.file_id = files.id
                                        ORDER BY albums.created_at DESC");
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getAlbumById(int $id) {
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT albums.*, files.path AS image 
                                        FROM albums 
                                        LEFT JOIN files ON albums.file_id = files.id 
                                        WHERE albums.id = :id");
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $album = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $album;
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getSongsByAlbumId(int $albumId): array{
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT * FROM songs WHERE album_id = :albumId");
            $stmt->bindParam(':albumId', $albumId, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function add($title, $author, $trackNumber, $editor, $isAvailable, $fileId = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO albums (title, author, trackNumber, editor, isAvailable, created_at, updated_at, file_id) 
                                VALUES (:title, :author, :trackNumber, :editor, :isAvailable, NOW(), NOW(), :fileId)');
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, \PDO::PARAM_STR);
        $stmt->bindParam(':trackNumber', $trackNumber, \PDO::PARAM_INT);
        $stmt->bindParam(':editor', $editor, \PDO::PARAM_STR);
        $stmt->bindParam(':isAvailable', $isAvailable, \PDO::PARAM_BOOL);
        if ($fileId !== null) {
            $stmt->bindParam(':fileId', $fileId, \PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':fileId', null, \PDO::PARAM_NULL);
        }
        $stmt->execute();
    }

    public static function update($id, $title, $author, $trackNumber, $editor, $isAvailable, $fileId = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('UPDATE albums 
                                SET title = :title, author = :author, trackNumber = :trackNumber, editor = :editor, isAvailable = :isAvailable, updated_at = NOW(), file_id = :fileId
                                WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, \PDO::PARAM_STR);
        $stmt->bindParam(':trackNumber', $trackNumber, \PDO::PARAM_INT);
        $stmt->bindParam(':editor', $editor, \PDO::PARAM_STR);
        $stmt->bindParam(':isAvailable', $isAvailable, \PDO::PARAM_BOOL);
        if ($fileId !== null) {
            $stmt->bindParam(':fileId', $fileId, \PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':fileId', null, \PDO::PARAM_NULL);
        }
        $stmt->execute();
    }

    public static function delete($id): void
    {
        $db = Database::connection();
        try {
            $stmt = $db->prepare('DELETE FROM albums WHERE id = :id');
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}