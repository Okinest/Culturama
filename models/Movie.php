<?php

namespace models;

use models\database\Database;
use PDOException;

enum Genre {
    case Action;
    case Comedy;
    case Drama;
    case Horror;
    case SciFi;
    case Documentary;
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
            $stmt = $db->prepare("SELECT * FROM movies ORDER BY created_at DESC");
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
}