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
                        <img src="/<?= htmlspecialchars($movie['file_path']) ?>" alt="<?= $movie['title'] ?>" class="w-32 h-40 object-cover rounded mb-2">
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
                            <input type="checkbox" name="isAvailable" class="ml-1" disabled
                                   value="<?= $movie['isAvailable'] ?>" <?= $movie['isAvailable'] ? 'checked' : '' ?>>
                        </div>
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="mt-2">
                                <a href="/movie/show/<?= $movie['id'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Voir plus</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="w-full md:w-1/3 p-2 flex items-center justify-center">
                <div class="bg-blue-500 rounded shadow p-6 cursor-pointer">
                    <a href="/movie/add" class="flex items-center">
                        <i class="fa-solid fa-plus text-white"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
