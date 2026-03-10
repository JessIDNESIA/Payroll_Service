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
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 right-0 p-8">
            <div
                class="px-4 py-1 bg-orange-50 text-orange-600 rounded-full text-xs font-black uppercase tracking-widest">
                Growth Metrics</div>
        </div>

        <h3 class="text-2xl font-black text-gray-800 mb-8 flex items-center gap-3">
            <span class="w-3 h-8 bg-blue-500 rounded-full"></span>
            Statistik Pertumbuhan Karyawan
        </h3>

        <div class="h-[400px] w-full relative">
            <canvas id="employeeChart" class="w-full h-full"></canvas>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                const initChart = () => {
                    const canvas = document.getElementById('employeeChart');
                    if (!canvas) return;

                    const ctx = canvas.getContext('2d');
                    if (window.myDashboardChart) {
                        window.myDashboardChart.destroy();
                    }

                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.1)');
                    gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

                    window.myDashboardChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($chartData['labels']),
                            datasets: [{
                                ...@json($chartData['datasets'][0]),
                                backgroundColor: gradient,
                                fill: true,
                                pointBackgroundColor: '#fff',
                                pointBorderColor: 'rgb(59, 130, 246)',
                                pointBorderWidth: 3,
                                pointRadius: 5,
                                pointHoverRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0,0,0,0.03)'
                                    },
                                    ticks: {
                                        stepSize: 1,
                                        font: { weight: 'bold' }
                                    }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: { font: { weight: 'bold' } }
                                }
                            },
                            plugins: {
                                legend: { display: false }
                            }
                        }
                    });
                };

                initChart();

                // Re-init on Livewire updates if necessary
                Livewire.on('refreshChart', () => {
                    initChart();
                });
            });
        </script>
    @endpush
</div>