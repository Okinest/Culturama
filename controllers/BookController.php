<?php
use models\Book;
function library(): void {
    $books = Book::getBooks();
    require_once ('views/book/library.php');
}
function show($id){
    $book = Book::getBookById($id);
    if (!$book) {
        header('Location: /book/library');
        exit;
    }
    require_once('views/book/show.php');
}
function add(){
    if (isset($_POST['bookTitle'], $_POST['bookAuthor'], $_POST['bookPageNumber'])) {
        $title = $_POST['bookTitle'];
        $author = $_POST['bookAuthor'];
        $pageNumber = $_POST['bookPageNumber'];
        $isAvailable = isset($_POST['isAvailable']);
        $filePath = null;

        if (isset($_FILES['bookImage']) && $_FILES['bookImage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/images/books/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['bookImage']['name']);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['bookImage']['tmp_name'], $targetPath)) {
                $filePath = $targetPath;
            }
        }

        if (!empty($title) && !empty($author) && !empty($pageNumber)){
            try {
                Book::add($title, $author, $pageNumber, $isAvailable, $filePath);
                $success = "Book added successfully !";
            } catch (Exception $e) {
                $message = "Error: " . $e->getMessage();
            }
        } else {
            $message = "Please fill in all fields.";
        }
    }
    require_once ('views/book/form.php');
}

function edit($id){
    $book = Book::getBookById($id);
    if (!$book) {
        header('Location: /book/library');
        exit;
    }
    if (isset($_POST['bookTitle'], $_POST['bookAuthor'], $_POST['bookPageNumber'])) {
        $title = $_POST['bookTitle'];
        $author = $_POST['bookAuthor'];
        $pageNumber = $_POST['bookPageNumber'];
        $isAvailable = isset($_POST['isAvailable']);
        $filePath = null;

        if (isset($_FILES['bookImage']) && $_FILES['bookImage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/images/books/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['bookImage']['name']);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['bookImage']['tmp_name'], $targetPath)) {
                $filePath = $targetPath;
            }
        }

        if (!empty($title) && !empty($author) && !empty($pageNumber)){
            try {
                Book::update($id, $title, $author, $pageNumber, $isAvailable, $filePath);
                $success = "Book updated successfully !";
                header('Location: /book/show/' . $id);
                exit;
            } catch (Exception $e) {
                $message = "Error: " . $e->getMessage();
            }
        } else {
            $message = "Please fill in all fields.";
        }
    }
    require_once ('views/book/edit.php');
}
function delete($id): void {
    try {
        Book::delete($id);
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }

    $books = Book::getBooks();
    require_once ('views/book/library.php');
}
function loan_return($id) {
    $album = Book::getBookById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'loan' && $album['isAvailable']) {
            Book::update($id, $album['title'], $album['author'], $album['pageNumber'],false, $album['file_path']);
        } elseif ($_POST['action'] === 'return' && !$album['isAvailable']) {
            Book::update($id, $album['title'], $album['author'], $album['pageNumber'],true, $album['file_path']);
        }
    }
    header('Location: /album/show/' . $id);
    exit;
}
