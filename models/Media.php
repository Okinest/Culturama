<?php

namespace models;

/**
 * Classe abstraite représentant un média.
 *
 * @property int $id Identifiant unique
 * @property string $title Titre du média
 * @property string $author Auteur ou créateur
 * @property bool $isAvailable Disponibilité
 * @property \DateTime $createdAt Date de création
 * @property \DateTime $updatedAt Date de mise à jour
 * @property string $filePath Chemin du fichier associé
 */
abstract class Media
{
    private int $id;
    private string $title;
    private string $author;
    private bool $isAvailable;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;
    private string $filePath;

    public function __construct(int $id, string $title, string $author, \DateTime $createdAt, \DateTime $updatedAt, string $filePath,bool $isAvailable = true)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->isAvailable = $isAvailable;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->filePath = $filePath;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
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
    public function getFilePath(): string
    {
        return $this->filePath;
    }
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }

}