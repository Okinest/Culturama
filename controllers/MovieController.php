<?php
use models\Movie;

function cinema(): void {
    $movies = Movie::getMovies();

    require_once ('views/movie/cinema.php');
}
