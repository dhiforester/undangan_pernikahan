<?php
    if(empty($_GET['Page'])){
        include "_Page/Dashboard/Dashboard.php";
    }else{
        $Page=$_GET['Page'];
        if($Page=="Akses"){
            include "_Page/Akses/Akses.php";
        }
        if($Page=="Kontak"){
            include "_Page/Kontak/Kontak.php";
        }
        if($Page=="SettingGeneral"){
            include "_Page/SettingGeneral/SettingGeneral.php";
        }
        if($Page=="MyProfile"){
            include "_Page/MyProfile/MyProfile.php";
        }
        if($Page=="Help"){
            include "_Page/Help/Help.php";
        }
        if($Page=="SettingEmail"){
            include "_Page/SettingService/SettingService.php";
        }
        if($Page=="Aktivitas"){
            include "_Page/Aktivitas/Aktivitas.php";
        }
    }
?>