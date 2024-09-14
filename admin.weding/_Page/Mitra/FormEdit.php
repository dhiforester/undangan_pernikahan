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
        <div class="col-md-4">
            <label for="nama_edit">Nama Mitra</label>
        </div>
        <div class="col-md-8">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" name="nama" id="nama_edit" class="form-control" value="<?php echo "$nama"; ?>">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kontak_edit">No. Telepon</label>
        </div>
        <div class="col-md-8">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="bi bi-telephone"></i>
                </span>
                <input type="text" name="kontak" id="kontak_edit" class="form-control" placeholder="62" value="<?php echo "$kontak"; ?>">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="email_edit">Email</label>
        </div>
        <div class="col-md-8">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" name="email" id="email_edit" class="form-control" placeholder="email@domain.com" value="<?php echo "$email"; ?>">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="password_edit">Password</label>
        </div>
        <div class="col-md-8">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="bi bi-key"></i>
                </span>
                <input type="password" name="password" id="password_edit" class="form-control" value="<?php echo "$password"; ?>">
            </div>
            <small class="credit">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Tampilkan" id="TampilkanPasswordEdit" name="TampilkanPasswordEdit">
                    <label class="form-check-label" for="TampilkanPasswordEdit">
                        Tampilkan Password
                    </label>
                </div>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="foto_edit">Foto Profil</label>
        </div>
        <div class="col-md-8">
            <input type="file" name="foto" id="foto_edit" class="form-control">
            <small class="credit">
                <code class="text text-grayish">Maksimal file 2 Mb (Tipe File: PNG, JPG, JPEG, GIF)</code>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <small class="credit">Pastikan data mitra yang anda input sudah sesuai</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4"></div>
        <div class="col col-md-8">
            <small class="credit" id="NotifikasiTambah"></small>
        </div>
    </div>
    <script>
        //Kondisi saat tampilkan password
        $('.form-check-input').click(function(){
            if($(this).is(':checked')){
                $('#password_edit').attr('type','text');
            }else{
                $('#password_edit').attr('type','password');
            }
        });
    </script>
<?php 
        }
    }
?>