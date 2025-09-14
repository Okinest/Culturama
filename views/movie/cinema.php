<?php
$pageTitle = "Culturama - Films";

require_once ('views/layout/head.php');
require_once ('views/layout/navbar.php');

?>
<div class="container mx-auto px-4">
    <h2 class="text-center text-2xl font-bold my-4">Liste des Films (total: <?= count($movies) ?>)</h2>
    <form method="post" action="/movie/search" class="mb-4">
        <div class="flex">
            <input type="text" name="search" placeholder="Rechercher un film..." class="w-full p-2 border border-gray-300 rounded-l" value="<?= $_POST['search'] ?? '' ?>">
            <button type="submit" class="bg-blue-500 text-white p-2">Rechercher</button>
            <button type="button" class="bg-gray-500 text-white p-2 rounded-r" onclick="window.location.href='/movie/cinema'">Réinitialiser</button>
        </div>
    </form>
    <div class="flex flex-wrap mt-8">
        <?php foreach ($movies as $movie): ?>
            <div class="w-full md:w-1/3 p-2">
                <div class="bg-white rounded shadow">
                    <div class="flex flex-col items-center p-6">
                        <span class="material-icons text-5xl mb-2">menu_movie</span>
                        <h4 class="text-lg font-semibold"><?= $movie['title'] ?></h4>
                        <p class="text-gray-700">Réalisateur : <?= $movie['director'] ?></p>
                        <p class="text-gray-700">
                            Durée :
                            <?php
                                $heures = intdiv($movie['duration'], 60);
                                $restant = $movie['duration'] % 60;
                                echo "{$heures}h" . ($restant ? "{$restant}" : "");
                            ?>
                        </p>
                        <p class="text-gray-700">Genre : <?= $movie['genre'] ?></p>
                        <div class="flex items-center">
                            <label for="isAvailable" class="text-gray-700">Disponible :</label>
                            <input name="isAvailable" type="checkbox" value="<?= $movie['isAvailable'] ?>"
                                   class="ml-1" <?= $movie['isAvailable'] ? 'checked' : '' ?> disabled>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
