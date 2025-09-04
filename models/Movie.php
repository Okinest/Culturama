<?php

namespace models;

use models\Media;

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
    private double $duration;
    private Genre $genre;

    public function __construct(string $title, string $author, double $duration, Genre $genre, bool $isAvailable = true)
    {
        parent::__construct($title, $author, $isAvailable);
        $this->duration = $duration;
        $this->genre = $genre;
    }

    public function getDuration(): double
    {
        return $this->duration;
    }

    public function setDuration(double $duration): void
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
}