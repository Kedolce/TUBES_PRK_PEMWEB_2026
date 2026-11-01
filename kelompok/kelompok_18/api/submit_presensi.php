<?php
header('Content-Type: application/json');
require_once '../config/database.php';

// Membaca data JSON yang dikirim via Fetch API
$input = json_decode(file_get_contents('php://input'), true);

$token = isset($input['token']) ? trim($input['token']) : '';
$latitude = isset($input['latitude']) ? $input['latitude'] : null;
$longitude = isset($input['longitude']) ? $input['longitude'] : null;

if (empty($token) || is_null($latitude) || is_null($longitude)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Data tidak lengkap. Token dan lokasi presisi diperlukan.'
    ]);
    exit;
}

// TODO: Nanti integrasikan dengan query cek token (Intan) & rumus Haversine (Deru)
// Contoh respon sementara (Mock Data Success)
echo json_encode([
    'status' => 'success',
    'message' => "Presensi Berhasil! Lokasi terdeteksi (Lat: {$latitude}, Lng: {$longitude})."
]);
