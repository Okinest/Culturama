<?php
$pageTitle = "Culturama - Modifier un album";
require_once('views/layout/head.php');
require_once('views/layout/navbar.php');
?>

<a href="/album/playlist" class="p-4 text-blue-600 flex items-center">
    <i class="fa-solid fa-arrow-left"></i>
</a>
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Modifier un album</h1>
    <form method="post" action="/album/edit/<?= $album['id']?>" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="albumTitle" class="block text-gray-700 font-medium mb-1">Titre:</label>
            <input type="text" id="albumTitle" name="albumTitle" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $album['title']?? ""?>">
        </div>
        <div>
            <label for="albumAuthor" class="block text-gray-700 font-medium mb-1">Auteur:</label>
            <input type="text" id="albumAuthor" name="albumAuthor" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $album['author']?? ""?>">
        </div>
        <div>
            <label for="albumTrackNumber" class="block text-gray-700 font-medium mb-1">Nombre de chansons:</label>
            <input type="number" id="albumTrackNumber" name="albumTrackNumber" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $album['trackNumber']??""?>">
        </div>
        <div>
            <label for="albumEditor" class="block text-gray-700 font-medium mb-1">Éditeur:</label>
            <input type="text" id="albumEditor" name="albumEditor" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $album['editor']?? ""?>">
        </div>
        <div class="flex items-center gap-2">
            <label for="isAvailable" class="block text-gray-700 font-medium mb-1">Disponible</label>
            <input type="checkbox" id="isAvailable" name="isAvailable" class="mr-2 align-middle"
                <?= !empty($album['isAvailable']) ? 'checked' : '' ?>>
        </div>
        <div class="text-center">
            <input type="submit" value="Modifier l'album" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer font-semibold">
        </div>
        <?php if (isset($message)): ?>
            <p class="text-center text-red-500 mt-4"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="text-center text-green-500 mt-4"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
    </form>
</div>
