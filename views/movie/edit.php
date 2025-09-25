<?php
use models\Genre;

$pageTitle = "Culturama - Modifier un film";
require_once ('views/layout/head.php');
require_once ('views/layout/navbar.php');
?>

<a href="/movie/cinema" class="p-4 text-blue-600 flex items-center">
    <i class="fa-solid fa-arrow-left"></i>
</a>
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Modifier un film</h1>
    <form method="post" action="/movie/edit/<?= $movie['id']?>" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="movieImage" class="block text-gray-700 font-medium mb-1">Image du film :</label>
            <input type="file" id="movieImage" name="movieImage" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded">
        </div>
        <div>
            <label for="movieTitle" class="block text-gray-700 font-medium mb-1">Titre:</label>
            <input type="text" id="movieTitle" name="movieTitle" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $movie['title']?? ""?>">
        </div>
        <div>
            <label for="movieDirector" class="block text-gray-700 font-medium mb-1">Réalisateur:</label>
            <input type="text" id="movieDirector" name="movieDirector" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $movie['director']?? ""?>">
        </div>
        <div>
            <label for="movieDuration" class="block text-gray-700 font-medium mb-1">Durée:</label>
            <input type="number" id="movieDuration" name="movieDuration" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $movie['duration']??""?>">
        </div>
        <div>
            <label for="movieGenre" class="block text-gray-700 font-medium mb-1">Genre:</label>
            <?php $selectedGenre = $movie['genre']??"" ?>
            <select id="movieGenre" name="movieGenre" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionnez un genre</option>
                <?php foreach (Genre::cases() as $genre): ?>
                    <option value="<?= $genre->name ?>" <?= ($selectedGenre === $genre->name) ? 'selected' : '' ?>>
                        <?= match($genre) {
                            Genre::Action => 'Action',
                            Genre::Comedy => 'Comédie',
                            Genre::Drama => 'Drame',
                            Genre::Horror => 'Horreur',
                            Genre::SciFi => 'Science-fiction',
                            Genre::Documentary => 'Documentaire',
                        } ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex items-center gap-2">
            <label for="isAvailable" class="block text-gray-700 font-medium mb-1">Disponible</label>
            <input type="checkbox" id="isAvailable" name="isAvailable" class="mr-2 align-middle"
                <?= !empty($movie['isAvailable']) ? 'checked' : '' ?>>
        </div>
        <div class="text-center">
            <input type="submit" value="Modifier le film" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer font-semibold">
        </div>
        <?php if (isset($message)): ?>
            <p class="text-center text-red-500 mt-4"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="text-center text-green-500 mt-4"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
    </form>
</div>
