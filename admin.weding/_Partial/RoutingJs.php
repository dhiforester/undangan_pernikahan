<?php 
    if(empty($_GET['Page'])){
        echo '<script type="text/javascript" src="_Page/Dashboard/Dashboard.js"></script>';
    }else{
        $Page=$_GET['Page'];
        if($Page=="MyProfile"){
            echo '<script type="text/javascript" src="_Page/MyProfile/MyProfile.js"></script>';
        }
        if($Page=="Akses"){
            echo '<script type="text/javascript" src="_Page/Akses/Akses.js"></script>';
        }
        if($Page=="Kontak"){
            echo '<script type="text/javascript" src="_Page/Kontak/Kontak.js"></script>';
        }
        if($Page=="SettingGeneral"){
            echo '<script type="text/javascript" src="_Page/SettingGeneral/SettingGeneral.js"></script>';
        }
        if($Page=="SettingEmail"){
            echo '<script type="text/javascript" src="_Page/SettingService/SettingService.js"></script>';
        }
        if($Page=="Aktivitas"){
            echo '<script type="text/javascript" src="_Page/Aktivitas/Aktivitas.js"></script>';
        }
        if($Page=="Help"){
            echo '<script type="text/javascript" src="_Page/Help/Help.js"></script>';
        }
    }
?>