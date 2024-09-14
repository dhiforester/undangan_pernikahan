<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    if(empty($_POST['tanggal'])){
        $tanggal=date('Y-m-d');
    }else{
        $tanggal=$_POST['tanggal'];
    }
    //Jumlah Anggota Yang Sudah Punya Kontak Di Tanggal Ini
    $AnggotaSelesai = mysqli_num_rows(mysqli_query($Conn, "SELECT DISTINCT id_anggota FROM distribusi_kontak WHERE tanggal='$tanggal'"));
    $AnggotaAktif = mysqli_num_rows(mysqli_query($Conn, "SELECT id_anggota FROM anggota WHERE status='Aktif'"));
    if($AnggotaSelesai<$AnggotaAktif){
        echo "Ada";
    }else{
        echo "Tidak Ada";
    }
?>