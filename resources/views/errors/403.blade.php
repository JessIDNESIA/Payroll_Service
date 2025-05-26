<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-black flex items-center justify-center min-h-screen text-white">

    <div class="bg-gray-900 p-10 rounded-xl shadow-2xl text-center space-y-5 border-2 border-red-600">
        <h1 class="text-6xl font-bold text-red-500 animate-pulse">ERROR 403</h1>
        <p class="text-xl text-white">Akses Ditolak: Kamu tidak punya izin ke halaman ini.</p>
        <p class="text-md italic text-red-400">Langkah lebih jauh tanpa izin akan tercatat sebagai pelanggaran.</p>
        
        <form action="{{ route('logout') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-800 text-white px-6 py-3 rounded-lg transition">
                Keluar Sekarang
            </button>
        </form>
    </div>

</body>
</html>
