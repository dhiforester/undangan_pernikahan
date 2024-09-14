<?php
    header('Content-Type: application/json');
    // Koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/SettingGeneral.php";

    // Fungsi untuk membuat nama file acak
    function generateRandomString($length = 10) {
        return bin2hex(random_bytes($length));
    }

    // Memeriksa apakah ada file yang diunggah
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $uploadDir = '../../assets/img/Help/'; // Pastikan path direktori tujuan benar

        // Dapatkan ekstensi file
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        // Buat nama file baru yang acak
        $newFileName = generateRandomString(8) . '.' . $fileExtension;
        $uploadFile = $uploadDir . $newFileName;

        // Memindahkan file yang diunggah ke direktori tujuan
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            echo json_encode(['location' => $base_url . '/assets/img/Help/' . $newFileName]);
        } else {
            echo json_encode(['error' => 'Gagal mengunggah file']);
        }
    } else {
        echo json_encode(['error' => 'Tidak ada file yang diunggah']);
    }
?>
