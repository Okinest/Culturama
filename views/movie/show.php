<?php
$pageTitle = "Détail du film";
require_once('views/layout/head.php');
require_once('views/layout/navbar.php');
?>
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <a href="/movie/cinema" class="text-blue-600 mb-4 inline-block"><i class="fa-solid fa-arrow-left"></i> </a>
    <div class="flex flex-col items-center">
        <img src="/<?= htmlspecialchars($movie['file_path']) ?>" alt="<?= $movie['title'] ?>" class="w-40 h-56 object-cover rounded mb-4">
        <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($movie['title']) ?></h2>
        <p class="mb-1"><strong>Auteur :</strong> <?= htmlspecialchars($movie['director']) ?></p>
        <p class="mb-1">
            <strong>Durée :</strong>
            <?php
            $heures = intdiv($movie['duration'], 60);
            $restant = $movie['duration'] % 60;
            echo "{$heures}h" . ($restant ? "{$restant}" : "");
            ?>
        </p>
        <p class="mb-1"><strong>Genre :</strong> <?= htmlspecialchars($movie['genre']) ?></p>
        <p class="mb-4"><strong>Disponible :</strong> <?= $movie['isAvailable'] ? 'Oui' : 'Non' ?></p>
        <div class="flex gap-4 mt-4">
            <?php if (isset($_SESSION['username'])): ?>
                <form method="post" action="/movie/loan_return/<?= $movie['id']  ?>">
                    <?php if ($movie['isAvailable']): ?>
                        <button type="submit" name="action" value="loan" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Emprunter</button>
                    <?php else: ?>
                        <button type="submit" name="action" value="return" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Rendre</button>
                    <?php endif; ?>
                </form>
            <?php endif; ?>
            <a href="/movie/edit/<?= $movie['id'] ?>" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
            <a href="/movie/delete/<?= $movie['id'] ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"">Supprimer</a>
        </div>
    </div>
</div>