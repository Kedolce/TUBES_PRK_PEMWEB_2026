<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Kehadiran Siswa</title>
    <!-- Tailwind CSS v4 / CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">📊 Rekapitulasi Kehadiran Siswa</h1>
        
        <!-- Tombol Aksi Ekspor Laporan -->
        <div class="flex gap-3 mb-6 flex-wrap">
            <button onclick="window.print()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">
                📄 Ekspor PDF / Cetak
            </button>
            <button onclick="eksporExcel()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                📊 Ekspor Excel
            </button>
        </div>

        <!-- Canvas Chart.js -->
        <div class="mb-8">
            <canvas id="kehadiranChart" width="400" height="200"></canvas>
        </div>

        <!-- Tabel Rekap Data -->
        <div class="overflow-x-auto">
            <table id="tabelRekap" class="w-full border-collapse border border-gray-300 text-left">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 p-2">Status</th>
                        <th class="border border-gray-300 p-2">Jumlah Siswa</th>
                        <th class="border border-gray-300 p-2">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 p-2">Hadir</td>
                        <td class="border border-gray-300 p-2">32</td>
                        <td class="border border-gray-300 p-2">80%</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-2">Sakit / Izin</td>
                        <td class="border border-gray-300 p-2">5</td>
                        <td class="border border-gray-300 p-2">12.5%</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-2">Alpa</td>
                        <td class="border border-gray-300 p-2">3</td>
                        <td class="border border-gray-300 p-2">7.5%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Inisialisasi Chart.js dengan Dummy Data
        const ctx = document.getElementById('kehadiranChart').getContext('2d');
        const kehadiranChart = new Chart(ctx, {
            type: 'bar', // Bisa diganti 'pie' atau 'doughnut'
            data: {
                labels: ['Hadir', 'Sakit / Izin', 'Alpa'],
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: [32, 5, 3],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.6)',  // Hijau
                        'rgba(234, 179, 8, 0.6)',   // Kuning
                        'rgba(239, 68, 68, 0.6)'    // Merah
                    ],
                    borderColor: [
                        'rgb(34, 197, 94)',
                        'rgb(234, 179, 8)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        // Ekspor Sederhana ke Format Excel (.csv)
        function eksporExcel() {
            let table = document.getElementById("tabelRekap");
            let rows = table.rows;
            let csvContent = "";

            for (let i = 0; i < rows.length; i++) {
                let row = [], cols = rows[i].querySelectorAll("td, th");
                for (let j = 0; j < cols.length; j++) {
                    row.push(cols[j].innerText);
                }
                csvContent += row.join(",") + "\n";
            }

            let blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.setAttribute("download", "Rekap_Kehadiran.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>
