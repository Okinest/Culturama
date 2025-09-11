<?php
use models\Book;
function library(): void {
    $books = Book::getBooks();
    require_once ('views/book/library.php');
}
function add(){
    if (isset($_POST['bookTitle'], $_POST['bookAuthor'], $_POST['bookPageNumber'], $_POST['isAvailable'])){
        $title = $_POST['bookTitle'];
        $author = $_POST['bookAuthor'];
        $pageNumber = $_POST['bookPageNumber'];
        $isAvailable = isset($_POST['isAvailable']);

        if (!empty($title) && !empty($author) && !empty($pageNumber)){
            $book = new Book($title, $author, $pageNumber, new \DateTime(), new \DateTime(), $isAvailable);
            $book->add($title, $author, $pageNumber, $isAvailable);
            $message = "Book added successfully !";
        } else {
            $message = "Please fill in all fields.";
        }
        header('Location:/book/index');
    }
}
