<?php
$pageTitle = "Détail de l'album";
require_once('views/layout/head.php');
require_once('views/layout/navbar.php');
?>
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <a href="/album/playlist" class="text-blue-600 mb-4 inline-block"><i class="fa-solid fa-arrow-left"></i> </a>
    <div class="flex flex-col items-center">
        <img src="/<?= htmlspecialchars($album['file_path'] ?? '') ?>" alt="<?= $album['title'] ?>" class="w-40 h-40 object-cover rounded mb-4">
        <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($album['title']) ?></h2>
        <p class="mb-1"><strong>Auteur :</strong> <?= htmlspecialchars($album['author']) ?></p>
        <p class="mb-1"><strong>Éditeur :</strong> <?= htmlspecialchars($album['editor']) ?></p>
        <p class="mb-1"><strong>Nombre de chansons :</strong> <?= $album['trackNumber'] ?></p>
        <p class="mb-4"><strong>Disponible :</strong> <?= $album['isAvailable'] ? 'Oui' : 'Non' ?></p>
        <h3 class="text-xl font-semibold mt-6 mb-2">Liste des chansons</h3>
        <ul class="w-full">
            <?php foreach ($songs as $song): ?>
                <li class="flex items-center justify-between bg-gray-100 rounded p-3 mb-2">
                    <span class="font-medium"><?= htmlspecialchars($song['title']) ?></span>
                    <span class="flex items-center gap-2">
                        <span>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fa-star <?= $i <= $song['rating'] ? 'fa-solid text-yellow-400' : 'fa-regular text-gray-400' ?>"></i>
                            <?php endfor; ?>
                        </span>
                        <span class="text-sm text-gray-600"><?= gmdate("i\:s", $song['duration']) ?></span>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="flex gap-4 mt-4">
            <a href="/album/edit/<?= $album['id'] ?>" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="/album/delete/<?= $album['id'] ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Supprimer</a>
        </div>
    </div>
</div>

