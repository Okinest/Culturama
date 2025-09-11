<?php

namespace models;

use models\database\Database;

class User
{
    private int $id;
    private string $email;
    private string $password;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(int $id, string $email, string $password, \DateTime $createdAt, \DateTime $updatedAt)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
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

    public function create($email,$password): User
    {
        try {
            $db = Database::connection();
            $stmt = $db->prepare("INSERT INTO users (email, password, created_at, updated_at) VALUES (:email, :password, NOW(), NOW())");

            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, \PDO::PARAM_STR);
            $stmt->execute();

            $user_id = $db->lastInsertId();

            return new User($user_id, $email, $hashedPassword, new \DateTime(), new \DateTime());
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getByEmail(string $email): ?User
    {
        try {
            $db = Database::connection();
            $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}