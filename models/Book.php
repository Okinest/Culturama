<?php

namespace models;

use models\database\Database;
use PDO;
use PDOException;

class Book extends Media
{
    private int $pageNumber;
    public function __construct(string $title, string $author, int $pageNumber, \DateTime $createdAt, \DateTime $updatedAt, bool $isAvailable = true)
    {
        parent::__construct($title, $author, $createdAt, $updatedAt, $isAvailable);
        $this->pageNumber = $pageNumber;
    }

    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber): void
    {
        $this->pageNumber = $pageNumber;
    }

    public static function getBooks() {
        try {
            $db = Database::connection();
            $stmt = $db->prepare('SELECT * FROM books ORDER BY created_at DESC');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function add($title, $author, $pageNumber, $isAvailable): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO books (title, author, pageNumber, isAvailable,created_at, updated_at) 
                                    VALUES (:title, :author, :pageNumber, :isAvailable, NOW(), NOW())');
        $stmt->bindParam(':title', $title,\PDO::PARAM_STR);
        $stmt->bindParam(':author', $author,\PDO::PARAM_STR);
        $stmt->bindParam(':pageNumber', $pageNumber,\PDO::PARAM_INT);
        $stmt->bindParam(':isAvailable', $isAvailable,\PDO::PARAM_BOOL);

        $stmt->execute();
    }
}