<?php
    date_default_timezone_set('Asia/Jakarta');
    $tahun = date('Y'); // Ambil tahun saat ini
    $bulan = date('m'); // Ambil bulan saat ini
    $jumlahHari = date('t'); // Ambil jumlah hari dalam bulan saat ini
    $data = [];

    for ($i = 1; $i <= $jumlahHari; $i++) {
        // Zero padding
        $hari = sprintf("%02d", $i);
        $WaktuPencarian = "$tahun-$bulan-$hari";
        $WaktuFormating = "$tahun-$bulan-$hari";
        $Waktu = strtotime($WaktuFormating);
        $Waktu = date('d', $Waktu); // Format hari dan bulan

        // Jumlah Log
        $JumlahLog = mysqli_num_rows(mysqli_query($Conn, "SELECT id_log FROM log WHERE datetime_log LIKE '%$WaktuPencarian%'"));

        // Jumlah Transaksi
        $JumlahLogHalaman = mysqli_num_rows(mysqli_query($Conn, "SELECT id_log_halaman FROM log_halaman WHERE datetime_log LIKE '%$WaktuPencarian%'"));

        $data[] = array(
            'x' => $Waktu,
            'yLog' => $JumlahLog,
            'yLogHalaman' => $JumlahLogHalaman
        );
    }

    $json = json_encode($data, JSON_PRETTY_PRINT);
    if (file_put_contents("_Page/Dashboard/GrafikAktivitas.json", $json)) {
        
    } else {
        echo '<small class="text-danger">Gagal Membuat File JSON</small>';
    }
?>
