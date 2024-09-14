<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Session.php";
    if(empty($SessionIdAkses)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center">';
        echo '      <small class="text-danger">Sesi Akses Sudah Berakhir, Silahkan Login Ulang</small>';
        echo '  </div>';
        echo '</div>';
    }else{
        //Tangkap id_supervisi
        if(empty($_POST['id_supervisi'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center">';
            echo '      <small class="text-danger">ID Anggota Tidak Boleh Kosong!</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_supervisi=$_POST['id_supervisi'];
            $id_supervisi=validateAndSanitizeInput($id_supervisi);
            //Buka Informasi
            $nama=GetDetailData($Conn,'supervisi','id_supervisi',$id_supervisi,'nama');
            $kontak=GetDetailData($Conn,'supervisi','id_supervisi',$id_supervisi,'kontak');
            $email=GetDetailData($Conn,'supervisi','id_supervisi',$id_supervisi,'email');
            $password=GetDetailData($Conn,'supervisi','id_supervisi',$id_supervisi,'password');
            $foto=GetDetailData($Conn,'supervisi','id_supervisi',$id_supervisi,'foto');
            if(empty($foto)){
                $foto="No-Image.PNG";
            }
?>
    <div class="row mb-3 border-1 border-bottom">
        <div class="col-md-12 text-center mb-4">
            <img src="<?php echo $base_url; ?>/assets/img/User/<?php echo $foto; ?>" alt="" width="120px" height="120px" class="rounded-circle">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Nama</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $nama; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Kontak</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $kontak; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Email</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $email; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Password</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $password; ?></code>
        </div>
    </div>
<?php 
        }
    }
?>