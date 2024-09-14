<?php
    if(empty($_GET['Sub'])){
        include "_Page/Supervisi/SupervisiHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailSupervisi"){
            include "_Page/Supervisi/DetailSupervisi.php";
        }else{
            include "_Page/Supervisi/SupervisiHome.php";
        }
    }
?>