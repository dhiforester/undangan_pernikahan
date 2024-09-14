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
        if(empty($_POST['id_mitra'])){
            echo '<code class="text-danger">ID Mitra Tidak Boleh Kosong</code>';
        }else{
            $id_mitra=$_POST['id_mitra'];
            $id_mitra=validateAndSanitizeInput($id_mitra);
            //Validasi
            $id_mitra=GetDetailData($Conn,'mitra','id_mitra',$id_mitra,'id_mitra');
            if(empty($id_mitra)){
                echo '<code class="text-danger">ID Tidak Tidak Valid Atau Tidak Ditemukan Pada Database</code>';
            }else{
                $HapusMitra = mysqli_query($Conn, "DELETE FROM mitra WHERE id_mitra='$id_mitra'") or die(mysqli_error($Conn));
                if($HapusMitra) {
                    //Apabila Ada File Foto Maka Di Hapus
                    $KategoriLog="Mitra";
                    $KeteranganLog="Hapus Mitra";
                    include "../../_Config/InputLog.php";
                    echo '<small class="text-success" id="NotifikasiHapusBerhasil">Success</small>';
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan Pada Saat Menghapus Data</code>';
                }
            }
        }
    }
?>