<?php
$pageTitle = "Culturama - Livres";

require_once ('views/layout/head.php');
require_once ('views/layout/navbar.php');

?>
<div class="mx-auto px-4">
    <h2 class="text-center text-2xl font-bold my-4">Liste des Livres (total: <?= count($books) ?>)</h2>
    <form method="get" action="/book/library" class="flex items-center">
        <label for="sort" class="mr-2">Trier par :</label>
        <select name="sort" id="sort" class="border rounded p-1 mr-2">
            <option value="title" <?= ($_GET['sort'] ?? '') === 'title' ? 'selected' : '' ?>>Titre</option>
            <option value="author" <?= ($_GET['sort'] ?? '') === 'author' ? 'selected' : '' ?>>Auteur</option>
            <option value="pageNumber" <?= ($_GET['sort'] ?? '') === 'pageNumber' ? 'selected' : '' ?>>Nombre de pages</option>
            <option value="created_at" <?= ($_GET['sort'] ?? '') === 'created_at' ? 'selected' : '' ?>>Date de création</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Trier</button>
    </form>
    <div class="flex flex-wrap mt-8">
        <?php foreach ($books as $book):?>
            <div class="w-full md:w-1/3 p-2">
                <div class="bg-white rounded shadow">
                    <div class="flex flex-col items-center p-6">
                        <img src="/<?= htmlspecialchars($book['file_path']) ?>" alt="<?= $book['title'] ?>" class="w-32 h-40 object-cover rounded mb-2">
                        <h4 class="text-lg font-semibold"><?= $book['title'] ?></h4>
                        <p class="text-gray-700">Auteur : <?= $book['author'] ?></p>
                        <p class="text-gray-700">Nombre de pages: <?= $book['pageNumber'] ?></p>
                        <div class="flex items-center">
                            <label for="isAvailable" class="text-gray-700">Disponible :</label>
                            <input name="isAvailable" type="checkbox" value="<?= $book['isAvailable'] ?>"
                                   class="ml-1" <?= $book['isAvailable'] ? 'checked' : '' ?> disabled>
                        </div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="mt-2">
                                <a href="/book/show/<?= $book['id'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Voir plus</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="w-full md:w-1/3 p-2 flex items-center justify-center">
                <div class="bg-blue-500 rounded shadow p-6 cursor-pointer">
                    <a href="/book/add" class="flex items-center">
                        <i class="fa-solid fa-plus text-white"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
