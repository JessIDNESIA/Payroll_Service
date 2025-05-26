<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payroll Service | Aman & Cepat</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

  <!-- Navbar -->
  <nav class="bg-white shadow fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex items-center">
          <span class="text-2xl font-extrabold text-orange-500">PayrollService</span>
        </div>
        <div class="hidden md:flex items-center space-x-6">
          <a href="#features" class="text-gray-700 hover:text-orange-500 transition">Fitur</a>
          <a href="#cta" class="text-gray-700 hover:text-orange-500 transition">Mulai</a>
          <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-500 transition">Login</a>
          <a href="{{ route('register') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">Register</a>
        </div>
        <!-- Hamburger -->
        <div class="md:hidden">
          <button id="menu-toggle" class="text-gray-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2">
      <a href="#features" class="block text-gray-700 hover:text-orange-500">Fitur</a>
      <a href="#cta" class="block text-gray-700 hover:text-orange-500">Mulai</a>
      <a href="{{ route('login') }}" class="block text-gray-700 hover:text-orange-500">Login</a>
      <a href="{{ route('register') }}" class="block bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">Register</a>
    </div>
  </nav>

  <!-- Hero -->
  <section class="pt-32 pb-20 bg-gradient-to-b from-orange-100 to-white text-center px-4">
    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">Kelola Gaji Karyawan dengan Mudah</h2>
    <p class="text-lg text-gray-600 mb-6 max-w-xl mx-auto">
      Solusi payroll otomatis, aman, dan akurat untuk usaha Anda. Hemat waktu dan tenaga dengan sistem kami.
    </p>
    <a href="#cta" class="inline-block bg-orange-500 text-white px-6 py-3 rounded-lg shadow hover:bg-orange-600 transition">
      Coba Gratis Sekarang
    </a>
  </section>

  <!-- Features -->
  <section id="features" class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4">
      <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Fitur Unggulan</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="p-6 rounded-lg shadow-md hover:shadow-xl transition text-center bg-gray-50">
          <div class="bg-orange-100 p-3 rounded-full w-fit mx-auto mb-4 text-2xl">💰</div>
          <h4 class="text-xl font-semibold text-gray-800 mb-2">Perhitungan Otomatis</h4>
          <p class="text-gray-600">Hitung gaji, pajak, dan potongan secara otomatis dan akurat.</p>
        </div>
        <div class="p-6 rounded-lg shadow-md hover:shadow-xl transition text-center bg-gray-50">
          <div class="bg-orange-100 p-3 rounded-full w-fit mx-auto mb-4 text-2xl">🔒</div>
          <h4 class="text-xl font-semibold text-gray-800 mb-2">Keamanan Data</h4>
          <p class="text-gray-600">Data payroll terenkripsi dan tersimpan aman di server kami.</p>
        </div>
        <div class="p-6 rounded-lg shadow-md hover:shadow-xl transition text-center bg-gray-50">
          <div class="bg-orange-100 p-3 rounded-full w-fit mx-auto mb-4 text-2xl">📈</div>
          <h4 class="text-xl font-semibold text-gray-800 mb-2">Laporan Lengkap</h4>
          <p class="text-gray-600">Unduh laporan gaji dan slip karyawan kapan saja.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section id="cta" class="py-20 bg-orange-500 text-white text-center px-4">
    <h3 class="text-3xl font-bold mb-4">Siap mengelola payroll lebih mudah?</h3>
    <p class="mb-6 text-lg">Daftarkan bisnis Anda dan nikmati kemudahan sistem payroll digital.</p>
    <a href="{{ route('register') }}" class="bg-white text-orange-600 px-6 py-3 rounded-lg shadow hover:bg-gray-100 transition">
      Daftar Sekarang
    </a>
  </section>

  <!-- Footer -->
  <footer class="text-center py-6 bg-gray-100 text-gray-600 text-sm">
    &copy; 2025 PayrollService. All rights reserved.
  </footer>

  <!-- Script for mobile menu -->
  <script>
    const toggleBtn = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');
    toggleBtn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
