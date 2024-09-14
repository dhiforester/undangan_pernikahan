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
        //Validasi id_kontak tidak boleh kosong
        if(empty($_POST['id_kontak'])){
            echo '<code class="text-danger">ID Tidak Boleh Kosong</code>';
        }else{
            $id_kontak=$_POST['id_kontak'];
            $id_kontak=validateAndSanitizeInput($id_kontak);
            //Validasi ID Anggota
            $id_kontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'id_kontak');
            if(empty($id_kontak)){
                echo '<code class="text-danger">ID Tidak Tidak Valid Atau Tidak Ditemukan Pada Database</code>';
            }else{
                $HapusKontak = mysqli_query($Conn, "DELETE FROM kontak WHERE id_kontak='$id_kontak'") or die(mysqli_error($Conn));
                if($HapusKontak) {
                    //Apabila Ada File Foto Maka Di Hapus
                    $KategoriLog="Kontak";
                    $KeteranganLog="Hapus Kontak";
                    include "../../_Config/InputLog.php";
                    echo '<small class="text-success" id="NotifikasiHapusBerhasil">Success</small>';
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan Pada Saat Menghapus Data</code>';
                }
            }
        }
    }
?>