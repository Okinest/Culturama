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

/**
 * Classe représentant un film.
 *
 * @property float $duration Durée du film en minutes
 * @property Genre $genre Genre du film
 *
 * Hérite de Media.
 */
class Movie extends Media
{
    private float $duration;
    private Genre $genre;

    public function __construct(int $id, string $title, string $author, float $duration, Genre $genre,\DateTime $createdAt, \DateTime $updatedAt, string $filePath, bool $isAvailable = true)
    {
        parent::__construct($id, $title, $author, $updatedAt, $createdAt, $filePath, $isAvailable);
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

    public static function getMovies($sort = 'created_at'): array {
        $allowedSorts = ['title', 'author', 'duration', 'genre', 'created_at'];
        $sort = in_array($sort, $allowedSorts) ? $sort : 'created_at';
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT * FROM movies ORDER BY $sort ASC");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public static function getMovieById(int $id) {
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT * FROM movies WHERE id = :id");
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
                $title = strtolower($movie['title']);
                $director = strtolower($movie['director']);

                $titleWords = explode(' ', $title);
                $directorWords = explode(' ', $director);
                foreach ($directorWords as $word) {
                    if (str_contains($word, $searchTerm) || levenshtein($searchTerm, $word) <= 2) {
                        $filtered[] = $movie;
                        continue 2;
                    }
                }
                foreach ($titleWords as $word) {
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
    public static function add($title, $director, $duration, $genre, $isAvailable, $filePath = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO movies (title, director, duration, genre, isAvailable, created_at, updated_at, file_path) 
                                    VALUES (:title, :director, :duration, :genre,:isAvailable, NOW(), NOW(), :filePath)');
        $stmt->bindParam(':title', $title,PDO::PARAM_STR);
        $stmt->bindParam(':director', $director,PDO::PARAM_STR);
        $stmt->bindParam(':duration', $duration,PDO::PARAM_INT);
        $stmt->bindValue(':genre', $genre->name,PDO::PARAM_STR);
        $stmt->bindParam(':isAvailable', $isAvailable,PDO::PARAM_BOOL);
        if ($filePath !== null) {
            $stmt->bindParam(':filePath', $filePath, PDO::PARAM_STR);
        } else {
            $stmt->bindValue(':filePath', null, PDO::PARAM_NULL);
        }

        $stmt->execute();
    }
    public static function update($id, $title, $director, $duration, $genre, $isAvailable, $filePath = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('UPDATE movies 
                                    SET title = :title, director = :director, duration = :duration, genre = :genre, isAvailable = :isAvailable, updated_at = NOW(), file_path = :filePath
                                    WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title,PDO::PARAM_STR);
        $stmt->bindParam(':director', $director,PDO::PARAM_STR);
        $stmt->bindParam(':duration', $duration,PDO::PARAM_INT);
        $stmt->bindValue(':genre', $genre->name,PDO::PARAM_STR);
        $stmt->bindParam(':isAvailable', $isAvailable,PDO::PARAM_BOOL);
        if ($filePath !== null) {
            $stmt->bindParam(':filePath', $filePath, PDO::PARAM_STR);
        } else {
            $stmt->bindValue(':filePath', null, PDO::PARAM_NULL);
        }

        $stmt->execute();
    }
    public static function delete($id): void
    {
        $db = Database::connection();
        try {
            $stmt = $db->prepare('SELECT file_path FROM movies WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $movie = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($movie && !empty($movie['file_path']) && file_exists($movie['file_path'])) {
                unlink($movie['file_path']);
            }

            $stmt = $db->prepare('DELETE FROM movies WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}