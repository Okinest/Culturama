<?php
$pageTitle = "Créer un compte";

require_once ('views/layout/head.php');
?>
<div class="min-h-screen bg-gray-100">
    <a href="/user/login" class="p-4 text-blue-600 flex items-center">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div class="flex items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b">
                <h2 class="text-2xl font-bold text-center text-gray-800">
                    Créer un compte
                </h2>
            </div>
            <div class="px-6 py-8">
                <form action="/user/register" method="post" class="space-y-6">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                            Nom d'utilisateur
                        </label>
                        <input type="text" class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" name="username" value="<?= $_POST['username']?? ""?>" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse e-mail</label>
                        <input type="email" class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" name="email" value="<?= $_POST['email']?? ""?>" required>
                        <p class="mt-2 text-sm text-red-500"><?php if(isset($mailTaken)) {echo ($mailTaken) ;}?></p>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <input type="password" class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password" required>
                        <p class="mt-2 text-sm text-red-500"><?php if(isset($weakPassword)) {echo ($weakPassword) ;}?></p>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">S'inscrire</button>
                    </div>
                    <p class="mt-2 text-sm text-green-500"><?php if(isset($message)) {echo ($message) ;}?></p>
                </form>
            </div>
        </div>
    </div>
</div>

