<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    $PesanTemplate=urlencode($PesanTemplate);
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($SessionIdAkses)){
        echo 'Error 1';
    }else{
        //Validasi id_kontak tidak boleh kosong
        if(empty($_POST['id_kontak'])){
            echo 'Error 2';
        }else{
            //Buat Variabel
            $id_kontak=$_POST['id_kontak'];
            //Bersihkan Variabel
            $id_kontak=validateAndSanitizeInput($id_kontak);
            $Update = mysqli_query($Conn,"UPDATE kontak SET 
                sudah_dihubungi='1'
            WHERE id_kontak='$id_kontak'") or die(mysqli_error($Conn)); 
            if($Update){
                $Entry="INSERT INTO pesan_terkirim (
                    id_kontak,
                    id_anggota,
                    datetime_pesan,
                    isi_pesan
                ) VALUES (
                    '$id_kontak',
                    '$SessionIdAkses',
                    '$now',
                    '$PesanTemplate'
                )";
                $Input=mysqli_query($Conn, $Entry);
                if($Input){
                    echo '<small id="NotifikasiKirimPesanBerhasil">Success</small>';
                }else{
                    echo 'Error 3';
                }
            }else{
                echo 'Error 4';
            }
        }
    }
?>