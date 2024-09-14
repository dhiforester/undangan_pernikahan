<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    //Harus Login Terlebih Dulu
    if(empty($SessionIdAkses)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center">';
        echo '      <code>Sesi Login Sudah Berakhir, Silahkan Login Ulang!</code>';
        echo '  </div>';
        echo '</div>';
    }else{
        //Tangkap id_akses
        if(empty($_POST['id_akses'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center">';
            echo '      <code>ID Akses Tidak Boleh Kosong</code>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_akses=$_POST['id_akses'];
            //Bersihkan Variabel
            $id_akses=validateAndSanitizeInput($id_akses);
            //Buka data askes
            $nama_akses=GetDetailData($Conn,'akses','id_akses',$id_akses,'nama');
            $email_akses=GetDetailData($Conn,'akses','id_akses',$id_akses,'email');
?>
        <input type="hidden" name="id_akses" id="id_akses_edit" value="<?php echo "$id_akses"; ?>">
        <div class="row mb-3">
            <div class="col col-md-4">
                <label for="nama_akses_edit">Nama Lengkap</label>
            </div>
            <div class="col col-md-8">
                <input type="text" name="nama_akses" id="nama_akses_edit" class="form-control" value="<?php echo "$nama_akses"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-4">
                <label for="email_akses_edit">Email</label>
            </div>
            <div class="col col-md-8">
                <input type="email" name="email_akses" id="email_akses_edit" class="form-control" value="<?php echo "$email_akses"; ?>">
            </div>
        </div>
<?php 
        } 
    } 
?>