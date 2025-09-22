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
            $stmt = $db->prepare("SELECT books.*, files.path AS image
                                        FROM books
                                        LEFT JOIN files ON books.file_id = files.id
                                        ORDER BY books.created_at ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getBookById(int $id) {
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT books.*, files.path AS image
                                        FROM books
                                        LEFT JOIN files ON books.file_id = files.id
                                        WHERE books.id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $book = $stmt->fetch(PDO::FETCH_ASSOC);
            return $book;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public static function add($title, $author, $pageNumber, $isAvailable, $fileId = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO books (title, author, pageNumber, isAvailable, created_at, updated_at, file_id) 
                                    VALUES (:title, :author, :pageNumber, :isAvailable, NOW(), NOW(), :fileId)');
        $stmt->bindParam(':title', $title,\PDO::PARAM_STR);
        $stmt->bindParam(':author', $author,\PDO::PARAM_STR);
        $stmt->bindParam(':pageNumber', $pageNumber,\PDO::PARAM_INT);
        $stmt->bindParam(':isAvailable', $isAvailable,\PDO::PARAM_BOOL);
        if ($fileId !== null) {
            $stmt->bindParam(':fileId', $fileId, \PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':fileId', null, \PDO::PARAM_NULL);
        }

        $stmt->execute();
    }
    public static function update($id, $title, $author, $pageNumber, $isAvailable, $fileId = null): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('UPDATE books 
                                    SET title = :title, author = :author, pageNumber = :pageNumber, isAvailable = :isAvailable, updated_at = NOW(), file_id = :fileId
                                    WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':title', $title,\PDO::PARAM_STR);
        $stmt->bindParam(':author', $author,\PDO::PARAM_STR);
        $stmt->bindParam(':pageNumber', $pageNumber,\PDO::PARAM_INT);
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
            $stmt = $db->prepare('DELETE FROM books WHERE id = :id');
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

}
