<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    $JumlahTotal = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak"));
    $KontakBelumTerhubung = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak WHERE id_anggota!='0'"));
    $BelumDihubungi = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak WHERE sudah_dihubungi='0'"));
    $AnggotaAktif = mysqli_num_rows(mysqli_query($Conn, "SELECT id_anggota FROM anggota WHERE status='Aktif'"));
    $RataRataCs=$BelumDihubungi/$AnggotaAktif;
    $RataRataCs=round($RataRataCs);
    //Format
    $BelumDihubungi = formatAngkaRibuJutaan($BelumDihubungi);
    $AnggotaAktif = formatAngkaRibuJutaan($AnggotaAktif);
    $KontakBelumTerhubung = formatAngkaRibuJutaan($KontakBelumTerhubung);
?>
    <div class="row">
        <div class="col-md-3 mb-4 text-center">
            <b class="card-title" title="Jumlah Semua Customer Service Aktif"> Jumlah CS</b><br>
            <h3 class="text text-secondary"><?php echo "$AnggotaAktif"; ?></h3>
        </div>
        <div class="col-md-3 mb-4 text-center">
            <b class="card-title" title="Jumlah kontak yang belum dihubungi">Belum Dihubungi</b><br>
            <h3 class="text text-secondary"><?php echo "$BelumDihubungi"; ?></h3>
        </div>
        <div class="col-md-3 mb-4 text-center">
            <b class="card-title" title="Jumlah kontak yang sudah dimiliki customer service">Kontak-CS</b><br>
            <h3 class="text text-secondary"><?php echo "$KontakBelumTerhubung"; ?></h3>
        </div>
        <div class="col-md-3 mb-4 text-center" title="Perhitungan Jumlah Kontak Per CS">
            <b class="card-title">Rata-Rata/CS</b><br>
            <h3 class="text text-secondary"><?php echo "$RataRataCs"; ?></h3>
        </div>
    </div>