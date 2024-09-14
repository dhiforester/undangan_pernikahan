<?php
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    //Tangkap data
    if(empty($_POST['urlencode'])){
        echo '<span class="text-danger">Pesan URL Encode Tidak Bole Kosong</span>';
    }else{
        $urlencode=$_POST['urlencode'];
        $UpdateSetting = mysqli_query($Conn,"UPDATE setting_general SET 
            script_pesan='$urlencode'
        WHERE id_setting_general='1'") or die(mysqli_error($Conn)); 
        if($UpdateSetting){
            $_SESSION ["NotifikasiSwal"]="Simpan Setting General Berhasil";
            echo '<small class="text-success" id="NotifikasiSettingScriptBerhasil">Success</small>';
        }else{
            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan mengaturan</small>';
        }
    }
?>