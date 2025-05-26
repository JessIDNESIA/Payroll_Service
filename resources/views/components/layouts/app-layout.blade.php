{{-- resources/views/components/layouts/app-layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Aplikasi Payroll' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Jika pakai Vite --}}
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen">
        {{-- Header --}}
        @include('layouts.navigation')

        {{-- Konten --}}
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
