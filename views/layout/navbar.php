<?php
?>
<nav class="flex justify-between items-center p-4 bg-gray-100">
    <a href="/" class="font-bold text-lg">
        Culturama
    </a>
    <div class="flex gap-4">
        <?php if (isset($_SESSION['username'])): ?>
            <p class="text-blue-600"><?= $_SESSION['username'] ?></p>
            <a href="/user/logout" title="Déconnexion">
                <i class="fa-solid fa-arrow-right-from-bracket h-6 text-red-600"></i>
            </a>
        <?php else: ?>
            <a href="/user/login" class="text-blue-600 hover:underline">Connexion</a>
        <?php endif; ?>
    </div>
</nav>
