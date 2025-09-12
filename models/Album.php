<?php

namespace models;

use models\database\Database;

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
            $stmt = $db->prepare("SELECT * FROM `albums` ORDER BY `title` ASC");
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}