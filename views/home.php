<?php
    require_once 'layout/head.php';
?>
<body>
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <h1 class="text-4xl text-[#2c3e50] mb-10">Bienvenue à la Médiathèque</h1>
    <div class="flex gap-8">
        <a href="/book/library" class="no-underline">
            <div class="bg-[#3498db] text-white px-12 py-8 rounded-xl shadow-lg text-2xl transition-colors duration-200">
                📚 Livres
            </div>
        </a>
        <a href="/movie/cinema" class="no-underline">
            <div class="bg-[#e74c3c] text-white px-12 py-8 rounded-xl shadow-lg text-2xl transition-colors duration-200">
                🎬 Films
            </div>
        </a>
        <a href="albums" class="no-underline">
            <div class="bg-[#27ae60] text-white px-12 py-8 rounded-xl shadow-lg text-2xl transition-colors duration-200">
                🎵 Albums
            </div>
        </a>
    </div>
</div>
</body>


