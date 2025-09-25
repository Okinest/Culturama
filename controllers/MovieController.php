<?php
require_once __DIR__ . "/../models/Movie.php";
use models\Movie;
use models\Genre;

function cinema(): void {
    $movies = Movie::getMovies();

    require_once ('views/movie/cinema.php');
}
function search(): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $searchTerm = $_POST['search'] ?? '';

        $movies = Movie::searchMovies($searchTerm);

        require_once ('views/movie/cinema.php');
    } else {
        header('Location: /movie/cinema');
        exit();
    }
}
function show($id){
    $movie = Movie::getMovieById($id);
    if (!$movie) {
        header('Location: /movie/library');
        exit;
    }
    require_once('views/movie/show.php');
}
function add(){
    if (isset($_POST['movieTitle'], $_POST['movieDirector'], $_POST['movieDuration'])) {
        $title = $_POST['movieTitle'];
        $director = $_POST['movieDirector'];
        $duration = $_POST['movieDuration'];
        $genre = Genre::from($_POST['movieGenre']);
        $isAvailable = isset($_POST['isAvailable']);
        $filePath = null;

        if (isset($_FILES['movieImage']) && $_FILES['movieImage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/images/movies/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['movieImage']['name']);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['movieImage']['tmp_name'], $targetPath)) {
                $filePath = $targetPath;
            }
        }

        if (!empty($title) && !empty($director) && !empty($duration)) {
            try {
                Movie::add($title, $director, $duration, $genre, $isAvailable, $filePath);
                $success = "Movie added successfully !";
            } catch (Exception $e) {
                $message = "Error: " . $e->getMessage();
            }
        } else {
            $message = "Please fill in all fields.";
        }
    }
    require_once ('views/movie/form.php');
}

function edit($id){
    $movie = Movie::getMovieById($id);
    if (!$movie) {
        header('Location: /movie/cinema.php');
        exit;
    }
    if (isset($_POST['movieTitle'], $_POST['movieDirector'], $_POST['movieDuration'], $_POST['movieGenre'])) {
        $title = $_POST['movieTitle'];
        $director = $_POST['movieDirector'];
        $duration = $_POST['movieDuration'];
        $genre = Genre::from($_POST['movieGenre']);
        $isAvailable = isset($_POST['isAvailable']);
        $filePath = null;

        if (isset($_FILES['movieImage']) && $_FILES['movieImage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/images/movies/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['movieImage']['name']);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['movieImage']['tmp_name'], $targetPath)) {
                $filePath = $targetPath;
            }
        }

        if (!empty($title) && !empty($director) && !empty($duration)){
            try {
                Movie::update($id, $title, $director, $duration, $genre, $isAvailable, $filePath);
                $success = "Movie updated successfully !";
                header('Location: /movie/show/' . $id);
                exit;
            } catch (Exception $e) {
                $message = "Error: " . $e->getMessage();
            }
        } else {
            $message = "Please fill in all fields.";
        }
    }
    require_once ('views/movie/edit.php');
}
function delete($id): void {
    try {
        Movie::delete($id);
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }

    $movies = Movie::getMovies();
    require_once ('views/movie/cinema.php');
}
