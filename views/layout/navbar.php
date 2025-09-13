<?php
?>
<nav class="flex justify-between items-center p-4 bg-gray-100">
    <a href="/" class="font-bold text-lg">
        Culturama
    </a>
    <div>
        <?php if (isset($_SESSION['user'])): ?>
            <p class="text-blue-600">Bonjour, <?= $_SESSION['user'] ?></p>
            <a href="/logout.php" title="Déconnexion">
                <img src="/assets/logout.svg" alt="Déconnexion" class="h-6">
            </a>
        <?php else: ?>
            <a href="/user/form" class="text-blue-600 hover:underline">Connexion</a>
        <?php endif; ?>
    </div>
</nav>
