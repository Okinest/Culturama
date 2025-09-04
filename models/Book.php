<?php

namespace models;

use models\Media;

class Book extends Media
{
    private int $pageNumber;

    public function __construct(string $title, string $author, int $pageNumber, bool $isAvailable = true)
    {
        parent::__construct($title, $author, $isAvailable);
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
}