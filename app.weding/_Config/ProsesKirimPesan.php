<?php
    include('Connection.php');

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = trim($_POST['nama']);
        $pesan = trim($_POST['pesan']);

        // Periksa koneksi
        if ($Conn === null) {
            echo json_encode(['success' => false, 'message' => 'Koneksi ke database gagal.']);
            exit;
        }

        // Validasi Nama
        if (!preg_match("/^[A-Za-z\s]+$/", $nama) || strlen($nama) > 50) {
            echo json_encode(['success' => false, 'message' => 'Nama tidak valid']);
            exit;
        }

        // Validasi Pesan
        if (strlen($pesan) > 500) {
            echo json_encode(['success' => false, 'message' => 'Pesan terlalu panjang']);
            exit;
        }

        // Sanitasi Pesan
        $pesan = htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8');

        // Masukkan data ke database
        $datetime = date('Y-m-d H:i:s');
        $status = 'Draft';

        $query = "INSERT INTO testimoni (nama, pesan, datetime, status) VALUES (?, ?, ?, ?)";
        $stmt = $Conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('ssss', $nama, $pesan, $datetime, $status);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal menyimpan ke database']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyiapkan statement']);
        }

        $Conn->close();
    }
?>
