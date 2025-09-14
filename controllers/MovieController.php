<?php
use models\Movie;

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
