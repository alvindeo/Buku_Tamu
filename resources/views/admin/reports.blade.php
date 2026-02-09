<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <form method="GET" action="{{ route('reports') }}" class="flex items-center gap-4">
                            <select name="periode" class="rounded border-gray-300 dark:bg-gray-700 dark:text-white" onchange="this.form.submit()">
                                <option value="week" {{ $periode == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="month" {{ $periode == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="year" {{ $periode == 'year' ? 'selected' : '' }}>Tahun Ini</option>
                            </select>
                        </form>
                        
                        <button onclick="exportToExcel()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                            Export Excel (CSV)
                        </button>
                    </div>

                    <table id="reportTable" class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:bg-gray-700 dark:text-gray-300">Nama</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:bg-gray-700 dark:text-gray-300">No HP</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:bg-gray-700 dark:text-gray-300">Institusi</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:bg-gray-700 dark:text-gray-300">Masuk</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:bg-gray-700 dark:text-gray-300">Keluar</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:bg-gray-700 dark:text-gray-300">Durasi (Mnt)</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:bg-gray-700 dark:text-gray-300">Keperluan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $r)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">{{ $r->pengunjung->nama }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">{{ $r->pengunjung->no_hp }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">{{ $r->pengunjung->asal_institusi }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">{{ $r->tanggal_jam_masuk }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">{{ $r->tanggal_jam_keluar ?? '-' }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">{{ $r->durasi_kunjungan }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">{{ $r->keperluan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function exportToExcel() {
            let table = document.getElementById("reportTable");
            let rows = Array.from(table.rows);
            let csvContent = "data:text/csv;charset=utf-8,";

            rows.forEach(row => {
                let rowData = Array.from(row.cells).map(cell => '"' + cell.innerText + '"').join(",");
                csvContent += rowData + "\r\n";
            });

            let encodedUri = encodeURI(csvContent);
            let link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "laporan_kunjungan_{{ $periode }}.csv");
            document.body.appendChild(link);
            link.click();
        }
    </script>
</x-app-layout>
