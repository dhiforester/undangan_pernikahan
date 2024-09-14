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
        $nama_akses=GetDetailData($Conn,'akses','id_akses',$SessionIdAkses,'nama');
        $email_akses=GetDetailData($Conn,'akses','id_akses',$SessionIdAkses,'email');
?>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="nama_akses_profil">Nama Lengkap</label>
        </div>
        <div class="col col-md-8">
            <input type="text" name="nama_akses" id="nama_akses_profil" class="form-control" value="<?php echo "$nama_akses"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="email_akses_profil">Alamat Email</label>
        </div>
        <div class="col col-md-8">
            <input type="email" name="email_akses" id="email_akses_profil" class="form-control" value="<?php echo "$email_akses"; ?>">
        </div>
    </div>
<?php } ?>