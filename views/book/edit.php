<?php
$pageTitle = "Culturama - Modifier un livre";
require_once ('views/layout/head.php');
require_once ('views/layout/navbar.php');
?>

<a href="/book/library" class="p-4 text-blue-600 flex items-center">
    <i class="fa-solid fa-arrow-left"></i>
</a>
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Modifier un livre</h1>
    <form method="post" action="/book/edit/<?= $book['id']?>" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="bookImage" class="block text-gray-700 font-medium mb-1">Image du livre :</label>
            <input type="file" id="bookImage" name="bookImage" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded">
        </div>
        <div>
            <label for="bookTitle" class="block text-gray-700 font-medium mb-1">Titre:</label>
            <input type="text" id="bookTitle" name="bookTitle" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $book['title']?? ""?>">
        </div>
        <div>
            <label for="bookAuthor" class="block text-gray-700 font-medium mb-1">Auteur:</label>
            <input type="text" id="bookAuthor" name="bookAuthor" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $book['author']?? ""?>">
        </div>
        <div>
            <label for="bookPageNumber" class="block text-gray-700 font-medium mb-1">Nombre de pages:</label>
            <input type="number" id="bookPageNumber" name="bookPageNumber" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="<?= $book['pageNumber']??""?>">
        </div>
        <div class="flex items-center gap-2">
            <label for="isAvailable" class="block text-gray-700 font-medium mb-1">Disponible</label>
            <input type="checkbox" id="isAvailable" name="isAvailable" class="mr-2 align-middle"
                <?= !empty($book['isAvailable']) ? 'checked' : '' ?>>
        </div>
        <div class="text-center">
            <input type="submit" value="Modifier le livre" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer font-semibold">
        </div>
        <?php if (isset($message)): ?>
            <p class="text-center text-red-500 mt-4"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="text-center text-green-500 mt-4"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
    </form>
</div>
