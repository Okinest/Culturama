<?php

namespace models;

abstract class Media
{
    private string $title;
    private string $author;
    private bool $isAvailable;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(string $title, string $author, \DateTime $createdAt, \DateTime $updatedAt, bool $isAvailable = true)
    {
        $this->title = $title;
        $this->author = $author;
        $this->isAvailable = $isAvailable;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
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