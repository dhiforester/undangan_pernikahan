<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'Connection.php'; // Menghubungkan ke file koneksi
    date_default_timezone_set('Asia/Jakarta');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = trim($_POST['nama']);
        $kontak = trim($_POST['kontak']);
        $email = trim($_POST['email']);

        // Validasi Nama
        if (empty($nama) || !preg_match("/^[a-zA-Z\s]+$/", $nama)) {
            $error = "Nama harus diisi dan hanya boleh mengandung huruf dan spasi.";
        }
        // Validasi Kontak
        elseif (empty($kontak) || !preg_match("/^[0-9]+$/", $kontak)) {
            $error = "Kontak harus diisi dan hanya boleh mengandung angka.";
        }
        // Cek duplikat kontak
        else {
            $query = "SELECT id_attended FROM attended WHERE kontak = ?";
            $stmt = $Conn->prepare($query);
            $stmt->bind_param("s", $kontak);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $error = "Kontak sudah digunakan, harap masukkan kontak lain.";
            }
            $stmt->close();
        }
        // Validasi Email (opsional)
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Format email tidak valid.";
        }

        if (isset($error)) {
            // Kirim response gagal
            echo json_encode(['success' => false, 'message' => $error]);
        } else {
            // Insert data ke tabel attended
            $query = "INSERT INTO attended (datetime_attended, nama, kontak, email) VALUES (NOW(), ?, ?, ?)";
            $stmt = $Conn->prepare($query);
            $stmt->bind_param("sss", $nama, $kontak, $email);
            if ($stmt->execute()) {
                // Kirim response berhasil
                echo json_encode(['success' => true]);
            } else {
                // Kirim response gagal jika terjadi kesalahan saat insert
                echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
            }
            $stmt->close();
        }
    }
?>
