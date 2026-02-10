<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white p-4 rounded-3xl shadow-sm border border-tan/20">
            <h2 class="font-bold text-2xl text-deep-maroon leading-tight flex items-center gap-3">
                <span class="p-2 bg-primary-red rounded-xl text-cream">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </span>
                {{ __('Dashboard Kunjungan') }}
            </h2>
            <div id="realtime-clock" class="text-primary-red font-black text-xl bg-cream px-6 py-2 rounded-2xl border-2 border-tan shadow-inner"></div>
        </div>
    </x-slot>

    <div class="py-8 bg-cream min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Visitors -->
                <div class="bg-white border-b-4 border-primary-red rounded-3xl p-6 shadow-xl transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-cream rounded-2xl text-primary-red">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="text-tan text-xs font-black uppercase tracking-wider">Total Tamu</span>
                    </div>
                    <p class="text-4xl font-black text-deep-maroon leading-none">{{ $totalVisitors }}</p>
                    <p class="text-tan text-sm mt-3 font-bold">Basis Data Pengunjung</p>
                </div>

                <!-- Returning Visitors -->
                <div class="bg-primary-red rounded-3xl p-6 shadow-xl shadow-primary-red/20 transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-white/20 rounded-2xl text-cream">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </div>
                        <span class="text-cream/60 text-xs font-black uppercase tracking-wider">Retensi</span>
                    </div>
                    <p class="text-4xl font-black text-cream leading-none">{{ $returningVisitorsCount }}</p>
                    <p class="text-cream/80 text-sm mt-3 font-bold px-3 py-1 bg-deep-maroon/30 rounded-full inline-block">Loyalitas Tinggi</p>
                </div>

                <!-- Active Visitors -->
                <div class="bg-deep-maroon rounded-3xl p-6 shadow-xl shadow-deep-maroon/20 transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-white/10 rounded-2xl animate-pulse">
                            <div class="w-3 h-3 bg-primary-red rounded-full shadow-[0_0_10px_#A31D1D]"></div>
                        </div>
                        <span class="text-cream/50 text-xs font-black uppercase tracking-wider">Aktif</span>
                    </div>
                    <p class="text-4xl font-black text-cream leading-none">{{ count($tamuDiDalam) }}</p>
                    <p class="text-cream/40 text-sm mt-3 font-bold">Sedang Berkunjung</p>
                </div>

                <!-- Avg Time -->
                <div class="bg-white border-b-4 border-tan rounded-3xl p-6 shadow-xl transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-cream rounded-2xl text-tan">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-tan text-xs font-black uppercase tracking-wider">Rerata</span>
                    </div>
                    <p class="text-4xl font-black text-deep-maroon leading-none">{{ round($avgWeek) }}'</p>
                    <p class="text-tan text-sm mt-3 font-bold italic">Menit per tamu</p>
                </div>
            </div>

            <!-- Detailed Stats & Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Main Chart -->
                <div class="lg:col-span-2 bg-white rounded-[40px] p-8 shadow-2xl border border-tan/30">
                    <h3 class="text-xl font-black text-deep-maroon mb-8 flex items-center gap-3">
                        <span class="w-3 h-8 bg-primary-red rounded-full"></span>
                        Tren Kunjungan 7 Hari
                    </h3>
                    <div class="h-80">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>

                <!-- Secondary Chart / Stats -->
                <div class="bg-white rounded-[40px] p-8 shadow-2xl border border-tan/30">
                    <h3 class="text-xl font-black text-deep-maroon mb-8 flex items-center gap-3">
                        <span class="w-3 h-8 bg-tan rounded-full"></span>
                        Domisili Institusi
                    </h3>
                    <div class="h-80">
                        <canvas id="institutionChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- In-house Visitors Table -->
            <div class="bg-white rounded-[40px] overflow-hidden shadow-2xl border-2 border-tan/20">
                <div class="p-8 border-b-2 border-cream flex justify-between items-center bg-white">
                    <h3 class="text-2xl font-black text-deep-maroon uppercase tracking-tight">Tamu Dalam Gedung</h3>
                    <a href="{{ route('reports') }}" class="px-8 py-3 bg-primary-red text-cream rounded-2xl text-sm font-black hover:bg-deep-maroon transition-all shadow-lg shadow-primary-red/20">DETAIL LAPORAN</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-xs font-black text-tan uppercase tracking-widest bg-cream/50">
                                <th class="px-8 py-5">IDENTITAS LENGKAP</th>
                                <th class="px-8 py-5">INSTANSI</th>
                                <th class="px-8 py-5">WAKTU MASUK</th>
                                <th class="px-8 py-5 text-center">STATUS / KEPERLUAN</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream">
                            @foreach($tamuDiDalam as $tamu)
                            <tr class="hover:bg-cream/20 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="font-black text-deep-maroon text-lg">{{ $tamu->pengunjung->nama }}</div>
                                    <div class="text-tan text-xs font-bold">{{ $tamu->pengunjung->no_hp }}</div>
                                </td>
                                <td class="px-8 py-6 text-tan font-black uppercase tracking-wider">{{ $tamu->pengunjung->asal_institusi }}</td>
                                <td class="px-8 py-6">
                                    <span class="px-4 py-2 bg-cream border-2 border-tan/30 text-primary-red rounded-xl text-sm font-black italic">
                                        {{ \Carbon\Carbon::parse($tamu->tanggal_jam_masuk)->format('H:i') }} WIB
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-center">
                                        <span class="px-6 py-2 rounded-2xl text-xs font-black leading-relaxed max-w-[200px] text-center bg-tan/20 text-deep-maroon border border-tan/50">
                                            {{ strtoupper($tamu->keperluan) }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($tamuDiDalam) == 0)
                            <tr>
                                <td colspan="4" class="px-8 py-14 text-center">
                                    <div class="text-tan font-black text-xl italic opacity-30">AREA STERIL - TIDAK ADA TAMU AKTIF</div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js and Custom Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Real-time Clock
        function updateClock() {
            const now = new Date();
            const clock = document.getElementById('realtime-clock');
            clock.textContent = now.toLocaleTimeString('id-ID', { hour12: false });
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Chart Colors from Palette
        const primaryRed = '#A31D1D';
        const deepMaroon = '#6D2323';
        const tanColor = '#E5D0AC';
        const creamColor = '#FEF9E1';

        // Visitor Chart
        const visitorData = @json($tamuPerHari);
        new Chart(document.getElementById('visitorChart'), {
            type: 'bar', // Changed to BAR for better classic look
            data: {
                labels: visitorData.map(d => d.date),
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: visitorData.map(d => d.total),
                    backgroundColor: primaryRed,
                    hoverBackgroundColor: deepMaroon,
                    borderRadius: 15,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#F1F1F1' }, ticks: { color: '#6D2323', font: { weight: 'bold' } } },
                    x: { grid: { display: false }, ticks: { color: '#6D2323', font: { weight: 'bold' } } }
                }
            }
        });

        // Institution Chart
        const instData = @json($instansiTerbanyak);
        new Chart(document.getElementById('institutionChart'), {
            type: 'pie', // Changed to PIE for classic elegant feel
            data: {
                labels: instData.map(d => d.asal_institusi),
                datasets: [{
                    data: instData.map(d => d.total),
                    backgroundColor: [primaryRed, deepMaroon, '#D49B54', '#8E3200', '#42032C'],
                    borderWidth: 5,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { padding: 25, color: '#6D2323', font: { weight: 'black', size: 10 } } } }
            }
        });
        // Auto-refresh every 30 seconds to keep data realtime
        setTimeout(() => {
            location.reload();
        }, 30000);
    </script>
</x-app-layout>
