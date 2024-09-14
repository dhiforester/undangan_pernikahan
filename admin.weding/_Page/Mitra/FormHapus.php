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
        //Tangkap id_mitra
        if(empty($_POST['id_mitra'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center">';
            echo '      <small class="text-danger">ID Anggota Tidak Boleh Kosong!</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_mitra=$_POST['id_mitra'];
            $id_mitra=validateAndSanitizeInput($id_mitra);
            //Buka Informasi
            $nama=GetDetailData($Conn,'mitra','id_mitra',$id_mitra,'nama');
            $kontak=GetDetailData($Conn,'mitra','id_mitra',$id_mitra,'kontak');
            $email=GetDetailData($Conn,'mitra','id_mitra',$id_mitra,'email');
            $password=GetDetailData($Conn,'mitra','id_mitra',$id_mitra,'password');
            $foto=GetDetailData($Conn,'mitra','id_mitra',$id_mitra,'foto');
            if(empty($foto)){
                $foto='no_image.png';
            }
?>
    <input type="hidden" name="id_mitra" id="id_mitra" class="form-control" value="<?php echo "$id_mitra"; ?>">
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
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <small class="credit">
                    Apakah anda yakin akan menghapus data mitra ini?
                </small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <small class="credit" id="NotifikasiHapus">
                <!-- Notifikasi Hapus Muncul Disini -->
            </small>
        </div>
    </div>
<?php 
        }
    }
?>