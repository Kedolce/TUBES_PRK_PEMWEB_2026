/**
 * Fungsi untuk mengambil koordinat lokasi dan mengirim presensi
 * Modul 3: Geolocation API & AJAX (Anggota 5)
 */
function kirimPresensi() {
    const tokenInput = document.getElementById('token_input').value.trim();
    const btnSubmit = document.getElementById('btn_submit');
    const statusBox = document.getElementById('status_message');

    if (!tokenInput) {
        alert("Silakan masukkan token presensi terlebih dahulu!");
        return;
    }

    if (!navigator.geolocation) {
        alert("Browser Anda tidak mendukung Geolocation API.");
        return;
    }

    // Disable tombol saat proses berlangsung
    btnSubmit.disabled = true;
    statusBox.innerText = "Mengambil koordinat GPS...";

    navigator.geolocation.getCurrentPosition(
        (position) => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            statusBox.innerText = "Mengirimkan data presensi...";

            // Kirim data via Fetch API
            fetch('api/submit_presensi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    token: tokenInput,
                    latitude: latitude,
                    longitude: longitude
                })
            })
            .then(response => response.json())
            .then(data => {
                btnSubmit.disabled = false;
                if (data.status === 'success') {
                    statusBox.innerHTML = `<span style="color: green;">${data.message}</span>`;
                } else {
                    statusBox.innerHTML = `<span style="color: red;">${data.message}</span>`;
                }
            })
            .catch(error => {
                btnSubmit.disabled = false;
                console.error('Error:', error);
                statusBox.innerHTML = `<span style="color: red;">Gagal terhubung ke server.</span>`;
            });
        },
        (error) => {
            btnSubmit.disabled = false;
            let msg = "Gagal mengambil lokasi: ";
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    msg += "Izin lokasi ditolak oleh pengguna.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    msg += "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    msg += "Waktu permintaan lokasi habis.";
                    break;
                default:
                    msg += "Terjadi kesalahan tidak diketahui.";
            }
            statusBox.innerHTML = `<span style="color: red;">${msg}</span>`;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}
