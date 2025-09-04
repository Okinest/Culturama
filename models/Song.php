<?php

namespace models;

class Song
{
    private string $title;
    private int $duration; //  in seconds
    private int $rating; // rating out of 5

    public function __construct(string $title, int $duration, int $rating)
    {
        $this->title = $title;
        $this->duration = $duration;
        $this->rating = $rating;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }
}