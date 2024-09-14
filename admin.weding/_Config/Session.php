<?php
    //Menangkap seasson kemudian menampilkannya
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    if(empty($_SESSION["id_akses"])||empty($_SESSION["token"])){
        $SessionIdAkses="";
        $SessionToken="";
    }else{
        $SessionIdAkses=$_SESSION ["id_akses"];
        $SessionToken=$_SESSION ["token"];
        //Validasi Token Akses
        $QryAksesLogin = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($Conn));
        $DataAksesLogin = mysqli_fetch_array($QryAksesLogin);
        //Apabila Tidak Ada
        if(empty($DataAksesLogin['id_akses'])){
            $SessionIdAkses="";
            $SessionToken="";
        }else{
            //Validasi Apakah Token Masih Berlaku Atau Tidak
            $SessionDateExpired=$DataAksesLogin['datetime_expired'];
            $DateSekarang=date('Y-m-d H:i:s');
            if($DateSekarang>$SessionDateExpired){
                $SessionIdAkses="";
                $SessionToken="";
            }else{
                $SessionIdAkses=$DataAksesLogin['id_akses'];
                $SessionNama=$DataAksesLogin['nama'];
                if(empty($DataAksesLogin['foto'])){
                    $SessionGambar='No-Image.png';
                }else{
                    $SessionGambar=$DataAksesLogin['foto'];
                }
                $expired_milisecond=1000*60*60;
                $datetime_expired=calculateExpirationTimeFromDateTime($DateSekarang, $expired_milisecond);
                //Update Token Yang Ada
                $UpdateToken = mysqli_query($Conn,"UPDATE akses SET 
                    datetime_expired='$datetime_expired'
                WHERE id_akses='$SessionIdAkses'") or die(mysqli_error($Conn)); 
                if($UpdateToken){
                    $SessionToken=$DataAksesLogin['token'];
                }else{
                    $SessionToken="";
                }
            }
        }
    }
?>
