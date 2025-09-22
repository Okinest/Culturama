<?php

namespace models;

use models\database\Database;
use PDO;
use PDOException;

enum Genre {
    case Action;
    case Comedy;
    case Drama;
    case Horror;
    case SciFi;
    case Documentary;

    public static function from(string $name): self {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }
        throw new \ValueError("Invalid genre: $name");
    }
}
class Movie extends Media
{
    private float $duration;
    private Genre $genre;

    public function __construct(string $title, string $author, float $duration, Genre $genre,\DateTime $createdAt, \DateTime $updatedAt, bool $isAvailable = true)
    {
        parent::__construct($title, $author, $updatedAt, $createdAt, $isAvailable);
        $this->duration = $duration;
        $this->genre = $genre;
    }

    public function getDuration(): float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): void
    {
        $this->duration = $duration;
    }

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function setGenre(Genre $genre): void
    {
        $this->genre = $genre;
    }

    public static function getMovies(): array {
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT movies.*, files.path AS image
                                        FROM movies
                                        LEFT JOIN files ON movies.file_id = files.id
                                        ORDER BY movies.created_at DESC");
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public static function getMovieById(int $id) {
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT movies.*, files.path AS image
                                        FROM movies
                                        LEFT JOIN files ON movies.file_id = files.id
                                        WHERE movies.id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $movie = $stmt->fetch(PDO::FETCH_ASSOC);
            return $movie;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public static function searchMovies(string $searchTerm): array {
        try {
            $allMovies = self::getMovies();
            $searchTerm = strtolower($searchTerm);

            $filtered = [];
            foreach ($allMovies as $movie) {
                $director = strtolower($movie['director']);

                $directorWords = explode(' ', $director);
                foreach ($directorWords as $word) {
                    if (str_contains($word, $searchTerm) || levenshtein($searchTerm, $word) <= 2) {
                        $filtered[] = $movie;
                        continue 2;
                    }
                }

                $titleDistance = levenshtein(strtolower($searchTerm), strtolower($movie['title']));
                $directorDistance = levenshtein(strtolower($searchTerm), strtolower($movie['director']));
                if ($titleDistance <= 3 || $directorDistance <= 3) {
                    $filtered[] = $movie;
                }

            }
            return $filtered;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public static function add($title, $director, $duration, $genre, $isAvailable, $fileId = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO movies (title, director, duration, genre, isAvailable, created_at, updated_at, file_id) 
                                    VALUES (:title, :director, :duration, :genre,:isAvailable, NOW(), NOW(), :fileId)');
        $stmt->bindParam(':title', $title,\PDO::PARAM_STR);
        $stmt->bindParam(':director', $director,\PDO::PARAM_STR);
        $stmt->bindParam(':duration', $duration,\PDO::PARAM_INT);
        $stmt->bindValue(':genre', $genre->name,\PDO::PARAM_STR);
        $stmt->bindParam(':isAvailable', $isAvailable,\PDO::PARAM_BOOL);
        if ($fileId !== null) {
            $stmt->bindParam(':fileId', $fileId, \PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':fileId', null, \PDO::PARAM_NULL);
        }

        $stmt->execute();
    }
    public static function update($id, $title, $director, $duration, $genre, $isAvailable, $fileId = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('UPDATE movies 
                                    SET title = :title, director = :director, duration = :duration, genre = :genre, isAvailable = :isAvailable, updated_at = NOW(), file_id = :fileId
                                    WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':title', $title,\PDO::PARAM_STR);
        $stmt->bindParam(':director', $director,\PDO::PARAM_STR);
        $stmt->bindParam(':duration', $duration,\PDO::PARAM_INT);
        $stmt->bindValue(':genre', $genre->name,\PDO::PARAM_STR);
        $stmt->bindParam(':isAvailable', $isAvailable,\PDO::PARAM_BOOL);
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
            $stmt = $db->prepare('DELETE FROM movies WHERE id = :id');
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}