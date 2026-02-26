<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-800">
                {{ __('Edit Data Gaji') }}
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
                        <i class="fas fa-edit text-orange-500 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Edit Data Gaji</h3>
                    <p class="text-gray-600">Perbarui informasi gaji untuk karyawan</p>
                </div>

                <form action="{{ route('gaji.update', $gaji->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Nama Karyawan -->
                        <div class="space-y-2">
                            <label for="user_id" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-user text-orange-500 mr-2"></i>Nama Karyawan
                            </label>
                            <select name="user_id" id="user_id" 
                                class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 bg-white shadow-sm">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $gaji->user_id == $user->id ? 'selected' : '' }} class="py-2">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bulan -->
                        <div class="space-y-2">
                            <label for="bulan" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-calendar text-orange-500 mr-2"></i>Bulan
                            </label>
                            <input type="text" name="bulan" id="bulan" value="{{ $gaji->bulan }}"
                                class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                                placeholder="Contoh: Januari 2025" required>
                        </div>

                        <!-- Gaji Pokok -->
                        <div class="space-y-2">
                            <label for="gaji_pokok" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-wallet text-orange-500 mr-2"></i>Gaji Pokok
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                <input type="number" name="gaji_pokok" id="gaji_pokok" value="{{ $gaji->gaji_pokok }}"
                                    class="w-full border border-gray-300 rounded-xl p-4 pl-12 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                                    placeholder="0" required>
                            </div>
                        </div>

                        <!-- Tunjangan -->
                        <div class="space-y-2">
                            <label for="tunjangan" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-plus-circle text-green-500 mr-2"></i>Tunjangan
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                <input type="number" name="tunjangan" id="tunjangan" value="{{ $gaji->tunjangan }}"
                                    class="w-full border border-gray-300 rounded-xl p-4 pl-12 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                                    placeholder="0">
                            </div>
                        </div>

                        <!-- Potongan -->
                        <div class="space-y-2">
                            <label for="potongan" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-minus-circle text-red-500 mr-2"></i>Potongan
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                <input type="number" name="potongan" id="potongan" value="{{ $gaji->potongan }}"
                                    class="w-full border border-gray-300 rounded-xl p-4 pl-12 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                                    placeholder="0">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label for="status" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-check-circle text-orange-500 mr-2"></i>Status Pembayaran
                            </label>
                            <select name="status" id="status" 
                                class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 bg-white shadow-sm">
                                <option value="Belum Dibayar" {{ $gaji->status == 'Belum Dibayar' ? 'selected' : '' }} class="py-2">
                                    Belum Dibayar
                                </option>
                                <option value="Lunas" {{ $gaji->status == 'Lunas' ? 'selected' : '' }} class="py-2">
                                    Lunas
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Total Gaji Preview -->
                    <div class="bg-gradient-to-r from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-6 mb-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-700 mb-2">Total Gaji (Preview)</h4>
                                <p class="text-sm text-gray-600">Total akan dihitung otomatis berdasarkan input di atas</p>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl font-bold text-orange-600" id="total-preview">
                                    Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-6 py-4 rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 font-semibold text-lg flex items-center justify-center gap-3">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                        
                        <a href="{{ route('gaji.index') }}" 
                            class="flex-1 border-2 border-orange-500 text-orange-500 hover:bg-orange-50 px-6 py-4 rounded-xl transition font-semibold text-lg flex items-center justify-center gap-3">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Current Data Info -->
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info-circle text-white text-xl"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-blue-800 text-lg mb-3">Informasi Data Saat Ini</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-blue-700">Karyawan:</span>
                                <span class="font-medium text-blue-900">{{ $gaji->user->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-blue-700">Periode:</span>
                                <span class="font-medium text-blue-900">{{ $gaji->bulan }}</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-blue-700">Status Saat Ini:</span>
                                <span class="font-medium {{ $gaji->status == 'Lunas' ? 'text-green-600' : 'text-yellow-600' }}">
                                    {{ $gaji->status }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-blue-700">Total Gaji:</span>
                                <span class="font-medium text-blue-900">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
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

            // Add event listeners to all input fields
            [gajiPokokInput, tunjanganInput, potonganInput].forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            // Initialize calculation
            calculateTotal();
        });
    </script>
</x-app-layout>