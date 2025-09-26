<?php
$pageTitle = "Culturama - Musique";

require_once ('views/layout/head.php');
require_once ('views/layout/navbar.php');

?>
<div class="container mx-auto px-4">
    <h2 class="text-center text-2xl font-bold my-4">Liste des Albums (total: <?= count($albums) ?>)</h2>
    <form method="get" action="/album/playlist" class="flex items-center">
        <label for="sort" class="mr-2">Trier par :</label>
        <select name="sort" id="sort" class="border rounded p-1 mr-2">
            <option value="title" <?= ($_GET['sort'] ?? '') === 'title' ? 'selected' : '' ?>>Titre</option>
            <option value="author" <?= ($_GET['sort'] ?? '') === 'author' ? 'selected' : '' ?>>Auteur</option>
            <option value="editor" <?= ($_GET['sort'] ?? '') === 'editor' ? 'selected' : '' ?>>Éditeur</option>
            <option value="created_at" <?= ($_GET['sort'] ?? '') === 'created_at' ? 'selected' : '' ?>>Date de création</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Trier</button>
    </form>
    <div class="flex flex-wrap mt-8">
        <?php foreach ($albums as $album): ?>
            <div class="w-full md:w-1/3 p-2">
                <div class="bg-white rounded shadow">
                    <div class="flex flex-col items-center p-6">
                        <img src="/<?= htmlspecialchars($album['file_path'] ?? '') ?>" alt="<?= $album['title'] ?>" class="w-32 h-32 object-cover rounded mb-2">
                        <h4 class="text-lg font-semibold"><?= $album['title'] ?></h4>
                        <p class="text-gray-700">Auteur : <?= $album['author'] ?></p>
                        <p class="text-gray-700">Nombre de chansons : <?= $album['trackNumber'] ?></p>
                        <p class="text-gray-700">Éditeur : <?= $album['editor'] ?></p>
                        <div class="flex items-center">
                            <label for="isAvailable" class="text-gray-700">Disponible :</label>
                            <input name="isAvailable" type="checkbox" value="<?= $album['isAvailable'] ?>"
                                   class="ml-1" <?= $album['isAvailable'] ? 'checked' : '' ?> disabled>
                        </div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <a href="/album/show/<?= $album['id'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded mt-2">Voir plus</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="w-full md:w-1/3 p-2 flex items-center justify-center">
                <div class="bg-blue-500 rounded shadow p-6 cursor-pointer">
                    <a href="/album/add" class="flex items-center">
                        <i class="fa-solid fa-plus text-white"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
