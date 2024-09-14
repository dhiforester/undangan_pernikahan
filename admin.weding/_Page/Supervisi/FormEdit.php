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
    <input type="hidden" name="id_supervisi" value="<?php echo $id_supervisi; ?>">
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="nama_edit">Nama Lengkap</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nama" id="nama_edit" class="form-control" value="<?php echo $nama; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="kontak_edit">No.Kontak</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kontak" id="kontak_edit" class="form-control" placeholder="62" value="<?php echo $kontak; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="email_edit">Email</label>
        </div>
        <div class="col-md-8">
            <input type="email" name="email" id="email_edit" class="form-control" placeholder="email@domain.com" value="<?php echo $email; ?>">
        </div>
    </div>
    <div class="row mb-3" id="form_password">
        <div class="col col-md-4">
            <label for="password_edit">Password</label>
        </div>
        <div class="col-md-8">
            <input type="password" name="password" id="password_edit" class="form-control" value="<?php echo $password; ?>">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ya" id="tampilkan_password_edit" name="tampilkan_password_edit">
                <label class="form-check-label" for="tampilkan_password_edit">
                    <small>
                        <code class="text-dark">Tampilkan Password</code>
                    </small>
                </label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="foto_edit">Foto Profil</label>
        </div>
        <div class="col-md-8">
            <input type="file" name="foto" id="foto_edit" class="form-control">
            <small class="credit">
                <code class="text text-grayish">
                    File foto maksimal 2 Mb (JPG, JPEG, PNG dan GIF)
                </code>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4"></div>
        <div class="col-md-8">
            <code class="text-primary">Pastikan data supervisi yang anda input sudah benar</code>
        </div>
    </div>
    <script>
        //Validasi Kontak Hanya Boleh Angka
        $('#kontak_edit').keypress(function(event) {
            // Hanya mengizinkan angka (0-9) dan tombol kontrol seperti backspace
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        });
        //Menampilkan Password
        $('#tampilkan_password_edit').click(function(){
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