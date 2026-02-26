<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-800">
                {{ __('Tambah Gaji Karyawan') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-orange-100">
            <div class="p-8">
                <!-- Header Section -->
                <div class="mb-8 text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-money-bill-wave text-orange-500 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Tambah Data Gaji Baru</h3>
                    <p class="text-gray-600">Isi form berikut untuk menambahkan data gaji karyawan</p>
                </div>

                <form action="{{ route('gaji.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Karyawan -->
                        <div class="space-y-2">
                            <label for="user_id" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-user text-orange-500 mr-2"></i>Nama Karyawan
                            </label>
                            <select name="user_id" id="user_id"
                                class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 bg-white shadow-sm">
                                @foreach ($users as $user)
                                    @if ($user->name !== 'Admin')
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endif
                                @endforeach

                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bulan -->
                        <div class="space-y-2">
                            <label for="bulan" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-calendar text-orange-500 mr-2"></i>Bulan
                            </label>
                            <input type="text" name="bulan" id="bulan" value="{{ old('bulan') }}"
                                class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                                placeholder="Contoh: Januari 2025">
                            @error('bulan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gaji Pokok -->
                        <div class="space-y-2">
                            <label for="gaji_pokok" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-wallet text-orange-500 mr-2"></i>Gaji Pokok
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                <input type="number" name="gaji_pokok" id="gaji_pokok" value="{{ old('gaji_pokok') }}"
                                    class="w-full border border-gray-300 rounded-xl p-4 pl-12 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                                    placeholder="0">
                            </div>
                            @error('gaji_pokok')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tunjangan -->
                        <div class="space-y-2">
                            <label for="tunjangan" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-plus-circle text-green-500 mr-2"></i>Tunjangan
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                <input type="number" name="tunjangan" id="tunjangan" value="{{ old('tunjangan') }}"
                                    class="w-full border border-gray-300 rounded-xl p-4 pl-12 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                                    placeholder="0">
                            </div>
                            @error('tunjangan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Potongan -->
                        <div class="space-y-2">
                            <label for="potongan" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-minus-circle text-red-500 mr-2"></i>Potongan
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                <input type="number" name="potongan" id="potongan" value="{{ old('potongan') }}"
                                    class="w-full border border-gray-300 rounded-xl p-4 pl-12 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                                    placeholder="0">
                            </div>
                            @error('potongan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Total Gaji Preview -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-calculator text-orange-500 mr-2"></i>Total Gaji (Preview)
                            </label>
                            <div
                                class="bg-gradient-to-r from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-700">Estimasi Total:</span>
                                    <span class="text-2xl font-bold text-orange-600" id="total-preview">Rp 0</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">* Total akan dihitung otomatis berdasarkan input
                                    di atas</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-6 py-4 rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 font-semibold text-lg flex items-center justify-center gap-3">
                            <i class="fas fa-save"></i>
                            Simpan Gaji
                        </button>

                        <a href="{{ route('gaji.index') }}"
                            class="flex-1 border-2 border-orange-500 text-orange-500 hover:bg-orange-50 px-6 py-4 rounded-xl transition font-semibold text-lg flex items-center justify-center gap-3">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Card -->
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-lightbulb text-white text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-blue-800 text-lg mb-2">Tips Pengisian Gaji</h4>
                    <ul class="text-blue-700 space-y-2 text-sm">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>Pastikan bulan yang diisi sesuai dengan periode gaji</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>Isi tunjangan seperti transport, makan, atau bonus lainnya</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>Masukkan potongan seperti pajak, pinjaman, atau absensi</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Real-time total calculation
        document.addEventListener('DOMContentLoaded', function() {
            const gajiPokokInput = document.getElementById('gaji_pokok');
            const tunjanganInput = document.getElementById('tunjangan');
            const potonganInput = document.getElementById('potongan');
            const totalPreview = document.getElementById('total-preview');

            function calculateTotal() {
                const gajiPokok = parseInt(gajiPokokInput.value) || 0;
                const tunjangan = parseInt(tunjanganInput.value) || 0;
                const potongan = parseInt(potonganInput.value) || 0;

                const total = gajiPokok + tunjangan - potongan;
                totalPreview.textContent = 'Rp ' + formatNumber(total);
            }

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            [gajiPokokInput, tunjanganInput, potonganInput].forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            calculateTotal();
        });
    </script>
</x-app-layout>
