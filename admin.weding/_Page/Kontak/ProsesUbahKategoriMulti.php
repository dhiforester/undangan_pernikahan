<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Apabila Data Tidak Ada Yang Dipilih
    if(empty($_POST['id_kontak'])){
        echo '<code class="text-danger">Tidak ada data yang dipilih</code>';
    }else{
        if(empty($_POST['kategori'])){
            echo '<code class="text-danger">Kategori tidak boleh kosong!</code>';
        }else{
            $id_kontak=$_POST['id_kontak'];
            $kategori=$_POST['kategori'];
            $JumlahData=count($id_kontak);
            $JumlahBerhasil=0;
            foreach ($id_kontak as $IdKontak) {
                $UpdateKontak = mysqli_query($Conn,"UPDATE kontak SET 
                    kategori='$kategori'
                WHERE id_kontak='$IdKontak'") or die(mysqli_error($Conn)); 
                if($UpdateKontak){
                    $JumlahBerhasil=$JumlahBerhasil+1;
                }else{
                    $JumlahBerhasil=$JumlahBerhasil+0;
                }
            }
            if($JumlahData==$JumlahBerhasil){
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Kontak','Update Kategori Kontak');
                if($SimpanLog=="Success"){
                    echo '<code class="text-success" id="NotifikasiUbahKategoriMultiBerhasil">Success</code>';
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan log</code>';
                }
            }else{
                echo '<code class="text-danger">Ada beberapa data yang gagal di update!</code>';
            }
        }
    }
?>