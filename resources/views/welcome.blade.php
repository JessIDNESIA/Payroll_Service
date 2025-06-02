<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payroll Service | Aman & Cepat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

  <!-- Navbar -->
  <nav class="bg-white shadow fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex items-center">
          <span class="text-2xl font-extrabold text-orange-500 flex items-center">
            <i class="fas fa-coins mr-2"></i>PayrollService
          </span>
        </div>
        <div class="hidden md:flex items-center space-x-6">
          <a href="#features" class="text-gray-700 hover:text-orange-500 transition">Fitur</a>
          <a href="#cta" class="text-gray-700 hover:text-orange-500 transition">Mulai</a>
          <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-500 transition">Login</a>
          <a href="{{ route('register') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition transform hover:-translate-y-0.5 shadow-md">
            Register <i class="fas fa-arrow-right ml-1"></i>
          </a>
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
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2 bg-white shadow-lg">
      <a href="#features" class="block text-gray-700 hover:text-orange-500 py-2 border-b border-gray-100">Fitur</a>
      <a href="#cta" class="block text-gray-700 hover:text-orange-500 py-2 border-b border-gray-100">Mulai</a>
      <a href="{{ route('login') }}" class="block text-gray-700 hover:text-orange-500 py-2 border-b border-gray-100">Login</a>
      <a href="{{ route('register') }}" class="block bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition mt-2 text-center">
        Register <i class="fas fa-arrow-right ml-1"></i>
      </a>
    </div>
  </nav>

  <!-- Hero -->
  <section class="pt-32 pb-20 bg-gradient-to-b from-orange-50 to-white px-4">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="text-center lg:text-left">
        <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4 leading-tight">
          Kelola Gaji Karyawan <br><span class="text-orange-500">Lebih Mudah & Cepat</span>
        </h2>
        <p class="text-lg text-gray-600 mb-8 max-w-xl mx-auto lg:mx-0">
          Solusi payroll otomatis, aman, dan akurat untuk usaha Anda. Hemat waktu dan tenaga dengan sistem kami.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
          <a href="#cta" class="inline-block bg-orange-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-orange-600 transition transform hover:-translate-y-0.5">
            Coba Gratis Sekarang <i class="fas fa-rocket ml-2"></i>
          </a>
          <a href="#features" class="inline-block border-2 border-orange-500 text-orange-500 px-6 py-3 rounded-lg hover:bg-orange-50 transition">
            <i class="fas fa-play-circle mr-2"></i>Lihat Fitur
          </a>
        </div>
        
        <div class="mt-10 flex items-center justify-center lg:justify-start">
          <div class="flex -space-x-2">
            <div class="w-10 h-10 rounded-full bg-orange-200 border-2 border-white"></div>
            <div class="w-10 h-10 rounded-full bg-orange-300 border-2 border-white"></div>
            <div class="w-10 h-10 rounded-full bg-orange-400 border-2 border-white"></div>
          </div>
          <p class="ml-4 text-gray-600">500+ bisnis telah bergabung</p>
        </div>
      </div>
      
      <div class="relative">
        <div class="bg-orange-500 rounded-2xl p-1 shadow-xl">
          <div class="bg-white rounded-xl p-6 shadow-lg">
            <div class="flex justify-between items-center mb-4">
              <div>
                <div class="text-sm text-gray-500">Slip Gaji</div>
                <div class="font-bold">Januari 2025</div>
              </div>
              <div class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium">
                Dibayar
              </div>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mb-4">
              <div class="flex justify-between mb-2">
                <span>Nama Karyawan</span>
                <span class="font-medium">Budi Santoso</span>
              </div>
              <div class="flex justify-between mb-2">
                <span>Jabatan</span>
                <span>Marketing Manager</span>
              </div>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4 mb-4">
              <div class="flex justify-between mb-2">
                <span>Gaji Pokok</span>
                <span class="font-medium">Rp 8.500.000</span>
              </div>
              <div class="flex justify-between mb-2 text-green-600">
                <span>Bonus</span>
                <span>+ Rp 1.200.000</span>
              </div>
              <div class="flex justify-between text-red-600">
                <span>Potongan</span>
                <span>- Rp 750.000</span>
              </div>
            </div>
            
            <div class="flex justify-between font-bold text-lg pt-4 border-t border-gray-200">
              <span>Total Diterima</span>
              <span class="text-orange-500">Rp 8.950.000</span>
            </div>
          </div>
        </div>
        
        <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-yellow-400 rounded-full opacity-20"></div>
        <div class="absolute -top-6 -right-6 w-16 h-16 bg-orange-400 rounded-full opacity-20"></div>
      </div>
    </div>
  </section>

  <!-- Features -->
  <section id="features" class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4">
      <div class="text-center mb-16">
        <h3 class="text-3xl font-bold mb-4 text-gray-800 relative inline-block">
          Fitur Unggulan
          <div class="absolute bottom-0 left-0 right-0 h-1 bg-orange-200 transform translate-y-1"></div>
        </h3>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Solusi lengkap untuk manajemen payroll yang efisien dan bebas repot
        </p>
      </div>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 bg-gradient-to-br from-white to-orange-50 border border-orange-100 relative overflow-hidden">
          <div class="absolute top-4 right-4 text-orange-500 text-3xl">
            <i class="fas fa-calculator"></i>
          </div>
          <h4 class="text-xl font-semibold text-gray-800 mb-3">Perhitungan Otomatis</h4>
          <p class="text-gray-600 mb-4">Hitung gaji, pajak, dan potongan secara otomatis dan akurat dalam hitungan detik.</p>
          <ul class="space-y-2 text-gray-600">
            <li class="flex items-start">
              <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
              <span>Penghitungan PPh 21 otomatis</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
              <span>Penyesuaian lembur & tunjangan</span>
            </li>
          </ul>
        </div>
        
        <div class="p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 bg-gradient-to-br from-white to-orange-50 border border-orange-100 relative overflow-hidden">
          <div class="absolute top-4 right-4 text-orange-500 text-3xl">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h4 class="text-xl font-semibold text-gray-800 mb-3">Keamanan Data</h4>
          <p class="text-gray-600 mb-4">Data payroll terenkripsi dan tersimpan aman dengan sistem keamanan berlapis.</p>
          <ul class="space-y-2 text-gray-600">
            <li class="flex items-start">
              <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
              <span>Enkripsi AES-256</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
              <span>Backup harian otomatis</span>
            </li>
          </ul>
        </div>
        
        <div class="p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 bg-gradient-to-br from-white to-orange-50 border border-orange-100 relative overflow-hidden">
          <div class="absolute top-4 right-4 text-orange-500 text-3xl">
            <i class="fas fa-chart-line"></i>
          </div>
          <h4 class="text-xl font-semibold text-gray-800 mb-3">Laporan Lengkap</h4>
          <p class="text-gray-600 mb-4">Akses dan unduh laporan gaji serta slip karyawan kapan saja dalam berbagai format.</p>
          <ul class="space-y-2 text-gray-600">
            <li class="flex items-start">
              <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
              <span>Ekspor PDF, Excel, CSV</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
              <span>Analisis pengeluaran payroll</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-16 bg-gradient-to-r from-orange-400 to-orange-600 text-white">
    <div class="max-w-6xl mx-auto px-4">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div class="p-6">
          <div class="text-4xl font-bold mb-2">500+</div>
          <div class="text-orange-100">Pengguna Aktif</div>
        </div>
        <div class="p-6">
          <div class="text-4xl font-bold mb-2">1.2JT+</div>
          <div class="text-orange-100">Slip Diproses</div>
        </div>
        <div class="p-6">
          <div class="text-4xl font-bold mb-2">99.9%</div>
          <div class="text-orange-100">Uptime</div>
        </div>
        <div class="p-6">
          <div class="text-4xl font-bold mb-2">24/7</div>
          <div class="text-orange-100">Dukungan</div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section id="cta" class="py-20 bg-orange-500 text-white text-center px-4 relative overflow-hidden">
    <div class="absolute top-0 left-0 right-0 bottom-0 opacity-10">
      <div class="absolute top-20 left-10 w-40 h-40 rounded-full bg-white"></div>
      <div class="absolute bottom-10 right-10 w-60 h-60 rounded-full bg-white"></div>
    </div>
    
    <div class="max-w-3xl mx-auto relative z-10">
      <h3 class="text-3xl md:text-4xl font-bold mb-6">Siap mengelola payroll lebih mudah?</h3>
      <p class="mb-8 text-xl text-orange-100 max-w-2xl mx-auto">
        Daftarkan bisnis Anda sekarang dan nikmati kemudahan sistem payroll digital selama 14 hari gratis!
      </p>
      <a href="{{ route('register') }}" class="inline-block bg-white text-orange-600 px-8 py-4 rounded-lg shadow-lg hover:bg-gray-100 transition transform hover:-translate-y-0.5 font-bold text-lg">
        Daftar Sekarang <i class="fas fa-arrow-right ml-2"></i>
      </a>
      <p class="mt-6 text-orange-200">
        <i class="fas fa-lock mr-2"></i>Data Anda aman dan terjamin
      </p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center py-10 bg-gray-800 text-gray-400 text-sm">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex justify-center space-x-6 mb-6">
        <a href="#" class="hover:text-orange-400 transition">
          <i class="fab fa-facebook text-lg"></i>
        </a>
        <a href="#" class="hover:text-orange-400 transition">
          <i class="fab fa-twitter text-lg"></i>
        </a>
        <a href="#" class="hover:text-orange-400 transition">
          <i class="fab fa-instagram text-lg"></i>
        </a>
        <a href="#" class="hover:text-orange-400 transition">
          <i class="fab fa-linkedin text-lg"></i>
        </a>
      </div>
      
      <div class="mb-6">
        <span class="text-2xl font-extrabold text-orange-500">PayrollService</span>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-8">
        <div>
          <h4 class="font-semibold text-gray-300 mb-3">Perusahaan</h4>
          <ul class="space-y-2">
            <li><a href="#" class="hover:text-orange-400 transition">Tentang Kami</a></li>
            <li><a href="#" class="hover:text-orange-400 transition">Karir</a></li>
            <li><a href="#" class="hover:text-orange-400 transition">Blog</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold text-gray-300 mb-3">Layanan</h4>
          <ul class="space-y-2">
            <li><a href="#features" class="hover:text-orange-400 transition">Fitur</a></li>
            <li><a href="#" class="hover:text-orange-400 transition">Harga</a></li>
            <li><a href="#" class="hover:text-orange-400 transition">FAQ</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold text-gray-300 mb-3">Legal</h4>
          <ul class="space-y-2">
            <li><a href="#" class="hover:text-orange-400 transition">Kebijakan Privasi</a></li>
            <li><a href="#" class="hover:text-orange-400 transition">Syarat & Ketentuan</a></li>
          </ul>
        </div>
      </div>
      
      <div class="pt-6 border-t border-gray-700">
        &copy; 2025 PayrollService. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- Script for mobile menu -->
  <script>
    const toggleBtn = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');
    
    toggleBtn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
    
    // Close mobile menu when link is clicked
    const menuLinks = document.querySelectorAll('#mobile-menu a');
    menuLinks.forEach(link => {
      link.addEventListener('click', () => {
        menu.classList.add('hidden');
      });
    });
  </script>
</body>
</html>