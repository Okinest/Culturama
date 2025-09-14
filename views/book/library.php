<?php
$pageTitle = "Culturama - Livres";

require_once ('views/layout/head.php');
require_once ('views/layout/navbar.php');

?>
<div class="container mx-auto px-4">
    <h2 class="text-center text-2xl font-bold my-4">Liste des Livres (total: <?= count($books) ?>)</h2>
    <div class="flex flex-wrap mt-8">
        <?php foreach ($books as $book):?>
            <div class="w-full md:w-1/3 p-2">
                <div class="bg-white rounded shadow">
                    <div class="flex flex-col items-center p-6">
                        <span class="material-icons text-5xl mb-2">menu_book</span>
                        <h4 class="text-lg font-semibold"><?= $book['title'] ?></h4>
                        <p class="text-gray-700">Auteur : <?= $book['author'] ?></p>
                        <p class="text-gray-700">Nombre de pages: <?= $book['pageNumber'] ?></p>
                        <div class="flex items-center">
                            <label for="isAvailable" class="text-gray-700">Disponible :</label>
                            <input name="isAvailable" type="checkbox" value="<?= $book['isAvailable'] ?>"
                                   class="ml-1" <?= $book['isAvailable'] ? 'checked' : '' ?> disabled>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
