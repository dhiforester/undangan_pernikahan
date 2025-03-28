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
            echo '<code class="text-danger">ID tidak boleh kosong</code>';
        }else{
            //Validasi status tidak boleh kosong
            if(empty($_POST['status'])){
                echo '<code class="text-danger">Status tidak boleh kosong</code>';
            }else{
                $id_komentar=$_POST['id_komentar'];
                $status=$_POST['status'];
                //Bersihkan Variabel
                $id_komentar=validateAndSanitizeInput($id_komentar);
                $StatusKomentar=validateAndSanitizeInput($status);
                $UpdateStatus = mysqli_query($Conn,"UPDATE testimoni SET 
                    status='$StatusKomentar'
                WHERE id='$id_komentar'") or die(mysqli_error($Conn)); 
                if($UpdateStatus){
                    $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Komentar','Edit Komentar');
                    if($SimpanLog=="Success"){
                        echo '<small class="text-success" id="NotifikasiEditBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan log</small>';
                    }
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                }
            }
        }
    }
?>