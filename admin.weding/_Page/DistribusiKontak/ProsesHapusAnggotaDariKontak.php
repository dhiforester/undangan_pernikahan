<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    date_default_timezone_set("Asia/Jakarta");
    //Update semua kontak
    $Update = mysqli_query($Conn,"UPDATE kontak SET id_anggota='0'") or die(mysqli_error($Conn)); 
    if($Update){
        //Hapus Riwayat Distribusi
        $HapusDistribusi = mysqli_query($Conn, "DELETE FROM distribusi_kontak") or die(mysqli_error($Conn));
        if($HapusDistribusi){
            $KategoriLog="Distribusi Kontak";
            $KeteranganLog="Hapus CS Dari Kontak";
            include "../../_Config/InputLog.php";
            echo '<small class="text-success" id="NotifikasiHapusAnggotaDariKontakBerhasil">Success</small>';
        }else{
            echo '<small class="text-danger">Terjadi kesalahan pada saat menghapus data</small>';
        }
    }else{
        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
    }
?>