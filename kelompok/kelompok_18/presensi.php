<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Siswa - Attendara</title>
    <!-- Tailwind CSS v4 via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">📍 Presensi Siswa</h1>

        <form id="formPresensi" onsubmit="event.preventDefault(); kirimPresensi();" class="space-y-4">
            <div>
                <label for="token_input" class="block text-sm font-medium text-gray-700 mb-1">Kode Token Presensi</label>
                <input type="text" id="token_input" name="token" placeholder="Masukkan token 6 digit"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" />
            </div>

            <button type="submit" id="btn_submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg shadow transition disabled:opacity-50 disabled:cursor-not-allowed">
                Kirim Presensi
            </button>
        </form>

        <div id="status_message" class="mt-4 text-center text-sm"></div>
    </div>

    <script src="assets/js/presensi.js"></script>
</body>
</html>
