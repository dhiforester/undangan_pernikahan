<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    include "../../_Partial/FungsiAkses.php";
?>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="nama_akses_profil">Nama Lengkap</label>
        </div>
        <div class="col col-md-8">
            <input type="text" name="nama_akses" id="nama_akses_profil" class="form-control" value="<?php echo "$SessionNama"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="kontak_akses_profil">Nomor Kontak</label>
        </div>
        <div class="col col-md-8">
            <input type="text" name="kontak_akses" id="kontak_akses_profil" class="form-control" value="<?php echo "$SessionKontakAkses"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="email_akses_profil">Alamat Email</label>
        </div>
        <div class="col col-md-8">
            <input type="email" name="email_akses" id="email_akses_profil" class="form-control" value="<?php echo "$SessionEmailAkses"; ?>">
        </div>
    </div>