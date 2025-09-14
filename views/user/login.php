<?php
$pageTitle = "Login";

require_once ('views/layout/head.php');
?>
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b">
            <h2 class="text-2xl font-bold text-center text-gray-800">Connexion</h2>
        </div>
        <div class="px-6 py-8">
            <form action="/user/login" method="post" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse e-mail</label>
                    <input type="email" class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" name="email" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                    <input type="password" class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password" required>
                    <p class="mt-2 text-sm text-red-500"><?php if(isset($message)) {echo ($message) ;}?></p>
                </div>
                <div class="text-center">
                    <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">Se connecter</button>
                </div>
            </form>
            <a href="/user/register" class="block mt-4 text-center text-sm text-blue-600 hover:underline">Créer un compte</a>
        </div>
    </div>
</div>