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
            $stmt = $db->prepare("SELECT * FROM books ORDER BY created_at ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getBookById(int $id) {
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $book = $stmt->fetch(PDO::FETCH_ASSOC);
            return $book;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public static function add($title, $author, $pageNumber, $isAvailable, $filePath = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO books (title, author, pageNumber, isAvailable, created_at, updated_at, file_path) 
                                    VALUES (:title, :author, :pageNumber, :isAvailable, NOW(), NOW(), :filePath)');
        $stmt->bindParam(':title', $title,\PDO::PARAM_STR);
        $stmt->bindParam(':author', $author,\PDO::PARAM_STR);
        $stmt->bindParam(':pageNumber', $pageNumber,\PDO::PARAM_INT);
        $stmt->bindParam(':isAvailable', $isAvailable,\PDO::PARAM_BOOL);
        if ($filePath !== null) {
            $stmt->bindParam(':filePath', $filePath, \PDO::PARAM_STR);
        } else {
            $stmt->bindValue(':filePath', null, \PDO::PARAM_NULL);
        }

        $stmt->execute();
    }
    public static function update($id, $title, $author, $pageNumber, $isAvailable, $filePath = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('UPDATE books 
                                    SET title = :title, author = :author, pageNumber = :pageNumber, isAvailable = :isAvailable, updated_at = NOW(), file_path = :filePath
                                    WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':title', $title,\PDO::PARAM_STR);
        $stmt->bindParam(':author', $author,\PDO::PARAM_STR);
        $stmt->bindParam(':pageNumber', $pageNumber,\PDO::PARAM_INT);
        $stmt->bindParam(':isAvailable', $isAvailable,\PDO::PARAM_BOOL);
        if ($filePath !== null) {
            $stmt->bindParam(':filePath', $filePath, \PDO::PARAM_STR);
        } else {
            $stmt->bindValue(':filePath', null, \PDO::PARAM_NULL);
        }

        $stmt->execute();
    }
    public static function delete($id): void
    {
        $db = Database::connection();
        try {
            $stmt = $db->prepare('SELECT file_path FROM books WHERE id = :id');
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $book = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($book && !empty($book['file_path']) && file_exists($book['file_path'])) {
                unlink($book['file_path']);
            }

            $stmt = $db->prepare('DELETE FROM books WHERE id = :id');
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

}
