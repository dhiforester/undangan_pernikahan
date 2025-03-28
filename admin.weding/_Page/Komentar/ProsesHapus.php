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
        //Validasi id_komentar tidak boleh kosong
        if(empty($_POST['id_komentar'])){
            echo '<code class="text-danger">ID Tidak Boleh Kosong</code>';
        }else{
            $id_komentar=$_POST['id_komentar'];
            $id_komentar=validateAndSanitizeInput($id_komentar);
            //Validasi ID Anggota
            $HapusKomentar = mysqli_query($Conn, "DELETE FROM testimoni WHERE id='$id_komentar'") or die(mysqli_error($Conn));
            if($HapusKomentar) {
                //Apabila Ada File Foto Maka Di Hapus
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Komentar','Hapus Komentar');
                if($SimpanLog=="Success"){
                    echo '<small class="text-success" id="NotifikasiHapusBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan log</small>';
                }
            }else{
                echo '<code class="text-danger">Terjadi kesalahan Pada Saat Menghapus Data</code>';
            }
        }
    }
?>