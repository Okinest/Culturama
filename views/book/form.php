<?php
?>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Ajouter un livre</h1>
    <form method="post" action="/add" class="space-y-4">
        <div>
            <label for="bookTitle" class="block text-gray-700 font-medium mb-1">Titre:</label>
            <input type="text" id="bookTitle" name="bookTitle" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="bookAuthor" class="block text-gray-700 font-medium mb-1">Auteur:</label>
            <input type="text" id="bookAuthor" name="bookAuthor" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="bookPageNumber" class="block text-gray-700 font-medium mb-1">Nombre de pages:</label>
            <input type="number" id="bookPageNumber" name="bookPageNumber" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="isAvailable" class="block text-gray-700 font-medium mb-1">Disponible&nbsp;?</label>
            <input type="checkbox" id="isAvailable" name="isAvailable" class="mr-2 align-middle">
        </div>
        <div class="text-center">
            <input type="submit" value="Ajouter le livre" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer font-semibold">
        </div>
    </form>
</div>
</body>
</html>
