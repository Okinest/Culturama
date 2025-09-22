<?php
$pageTitle = "Détail du livre";
require_once('views/layout/head.php');
require_once('views/layout/navbar.php');
?>
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <a href="/book/library" class="text-blue-600 mb-4 inline-block"><i class="fa-solid fa-arrow-left"></i> </a>
    <div class="flex flex-col items-center">
        <img src="/<?= htmlspecialchars($book['image']) ?>" alt="<?= $book['title'] ?>" class="w-40 h-56 object-cover rounded mb-4">
        <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($book['title']) ?></h2>
        <p class="mb-1"><strong>Auteur :</strong> <?= htmlspecialchars($book['author']) ?></p>
        <p class="mb-1"><strong>Pages :</strong> <?= $book['pageNumber'] ?></p>
        <p class="mb-4"><strong>Disponible :</strong> <?= $book['isAvailable'] ? 'Oui' : 'Non' ?></p>
        <div class="flex gap-4 mt-4">
            <a href="/book/edit/<?= $book['id'] ?>" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="/book/delete/<?= $book['id'] ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"">Supprimer</a>
        </div>
    </div>
</div>