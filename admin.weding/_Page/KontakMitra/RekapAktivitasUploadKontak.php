<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    //Maping Bulan
    $month_map = array(
        "January" => "01",
        "February" => "02",
        "March" => "03",
        "April" => "04",
        "May" => "05",
        "June" => "06",
        "July" => "07",
        "August" => "08",
        "September" => "09",
        "October" => "10",
        "November" => "11",
        "December" => "12"
    );
    // Daftar semua bulan dalam satu tahun
    $all_months = array(
        "January", "February", "March", "April", "May", "June", 
        "July", "August", "September", "October", "November", "December"
    );
    // Array untuk menampung data jumlah kontak secara acak
    $data = array();
    // Mengisi array dengan nilai acak antara 50 dan 300 untuk setiap bulan
    foreach ($all_months as $month) {
        $AngkaBulan=$month_map[$month];
        $Tahun=date('Y');
        $Periode="$Tahun-$AngkaBulan";
        //Menghitung Jumlah Kontak Di periode Ini
        $JumlahKontak=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE id_mitra='$SessionIdAkses' AND datetime_import like '%$Periode%'"));
        $data[] = $JumlahKontak; // Nilai acak antara 50 dan 300
    }
    // Menyiapkan data untuk dikirim sebagai JSON
    $final_data = array(
        "labels" => $all_months,
        "data" => $data
    );
    // Mengirimkan data sebagai JSON
    echo json_encode($final_data);
?>
