<div class="space-y-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total User Login -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-orange-500 flex items-center gap-4">
            <div class="p-3 bg-orange-100 rounded-lg">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total User</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
            </div>
        </div>

        <!-- Total Pengajuan -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500 flex items-center gap-4">
            <div class="p-3 bg-blue-100 rounded-lg">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Pengajuan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalPengajuan }}</p>
            </div>
        </div>

        <!-- Total Karyawan -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500 flex items-center gap-4">
            <div class="p-3 bg-green-100 rounded-lg">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Karyawan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalKaryawan }}</p>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Grafik Pertumbuhan Karyawan</h3>
        <div class="h-[400px]">
            <canvas id="employeeChart"></canvas>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                const ctx = document.getElementById('employeeChart');
                new Chart(ctx, {
                    type: 'line',
                    data: @json($chartData),
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</div>