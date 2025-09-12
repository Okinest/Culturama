<?php
require_once ('views/layout/head.php');
require_once ('views/layout/navbar.php');
?>
<div class="container mx-auto px-4">
    <h2 class="text-center text-2xl font-bold my-4">Liste des Films (total: <?= count($movies) ?>)</h2>
    <div class="flex flex-wrap mt-8">
        <?php foreach ($movies as $movie): ?>
            <div class="w-full md:w-1/3 p-2">
                <div class="bg-white rounded shadow">
                    <div class="flex flex-col items-center p-6">
                        <span class="material-icons text-5xl mb-2">menu_movie</span>
                        <h4 class="text-lg font-semibold"><?= $movie['title'] ?></h4>
                        <p class="text-gray-700">Auteur : <?= $movie['director'] ?></p>
                        <p class="text-gray-700">Durée : <?= $movie['duration'] ?></p>
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
