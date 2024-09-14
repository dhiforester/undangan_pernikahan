<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($SessionIdAkses)){
        echo '<small class="text-danger">Sesi Akses Sudah Berakhir, Silahkan Login Ulang</small>';
    }else{
        if(empty($_POST['id_barang'])){
            echo '<span class="text-danger">ID Barang Tidak Boleh Kosong</span>';
        }else{
            $id_barang=$_POST['id_barang'];
            //Proses hapus data
            $HapusBarang= mysqli_query($Conn, "DELETE FROM barang WHERE id_barang='$id_barang'") or die(mysqli_error($Conn));
            if ($HapusBarang) {
                $KategoriLog="Barang";
                $KeteranganLog="Hapus Barang";
                include "../../_Config/InputLog.php";
                echo '<small class="text-success" id="NotifikkasiHapusBerhasil">Success</small>';
            }else{
                echo '<span class="text-danger">Hapus Barang Gagal</span>';
            }
        }
    }
?>