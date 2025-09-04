<?php

namespace models;

abstract class Media
{
    private string $title;
    private string $author;
    private bool $isAvailable;

    public function __construct(string $title, string $author, bool $isAvailable = true)
    {
        $this->title = $title;
        $this->author = $author;
        $this->isAvailable = $isAvailable;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function getAuthor(): string
    {
        return $this->author;
    }
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }
    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }
    public function loan(): void
    {
        $this->isAvailable = false;
    }
    public function return(): void
    {
        $this->isAvailable = true;
    }

}