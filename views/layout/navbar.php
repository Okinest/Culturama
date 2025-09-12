<?php
?>
<nav class="flex justify-between items-center p-4 bg-gray-100">
    <a href="/" class="font-bold text-lg">
        MonSite
    </a>
    <div>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="/logout.php" title="Déconnexion">
                <img src="/assets/logout.svg" alt="Déconnexion" class="h-6">
            </a>
        <?php else: ?>
            <a href="/login.php" class="text-blue-600 hover:underline">Connexion</a>
        <?php endif; ?>
    </div>
</nav>
