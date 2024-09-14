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
        //Tangkap id_anggota
        if(empty($_POST['id_anggota'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center">';
            echo '      <small class="text-danger">ID Anggota Tidak Boleh Kosong!</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_anggota=$_POST['id_anggota'];
            $id_anggota=validateAndSanitizeInput($id_anggota);
            //Buka Informasi
            $id_supervisi=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'id_supervisi');
            $email=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'email');
            $nama=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'nama');
            $password=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'password');
            $kontak=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'kontak');
            $foto=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'foto');
            $status=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'status');
?>
    <input type="hidden" name="id_anggota" value="<?php echo "$id_anggota"; ?>">
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="nama_edit">Nama</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nama" id="nama_edit" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="id_supervisi_edit">Supervisi</label>
        </div>
        <div class="col-md-8">
            <select name="id_supervisi" id="id_supervisi_edit"class="form-control">
                <option value="">Pilih</option>
                <?php
                    $QrySpv = mysqli_query($Conn, "SELECT id_supervisi, nama FROM supervisi ORDER BY nama ASC");
                    while ($DataSpv = mysqli_fetch_array($QrySpv)) {
                        $id_supervisi_list= $DataSpv['id_supervisi'];
                        $nama= $DataSpv['nama'];
                        if($id_supervisi_list==$id_supervisi){
                            echo '<option selected value="'.$id_supervisi_list.'">'.$nama.'</option>';
                        }else{
                            echo '<option value="'.$id_supervisi_list.'">'.$nama.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="kontak_edit">Kontak</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kontak" id="kontak_edit" class="form-control" placeholder="62" value="<?php echo "$kontak"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="email_edit">Email</label>
        </div>
        <div class="col-md-8">
            <input type="email" name="email" id="email_edit" class="form-control" placeholder="email@domain.com" value="<?php echo "$email"; ?>">
        </div>
    </div>
    <div class="row mb-3" id="form_password_edit">
        <div class="col col-md-4">
            <label for="password_edit">Password</label>
        </div>
        <div class="col-md-8">
            <input type="password" name="password" id="password_edit" class="form-control" value="<?php echo "$password"; ?>">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ya" id="tampilkan_password_anggota_edit" name="tampilkan_password_anggota">
                <label class="form-check-label" for="tampilkan_password_anggota_edit">
                    <small>
                        <code class="text-dark">Tampilkan Password</code>
                    </small>
                </label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="status_edit">Status</label>
        </div>
        <div class="col-md-8">
            <select name="status" id="status_edit" class="form-control">
                <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($status=="Aktif"){echo "selected";} ?> value="Aktif">Aktif</option>
                <option <?php if($status=="Keluar"){echo "selected";} ?> value="Keluar">Keluar</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="foto_edit">Foto</label>
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
            <code class="text-primary">Pastikan data yang anda input sudah benar</code>
        </div>
    </div>
    <script>
        var status_edit = $('#status_edit').val();
        //Validasi kontak_edit Hanya Boleh Angka
        $('#kontak_edit').keypress(function(event) {
            // Hanya mengizinkan angka (0-9) dan tombol kontrol seperti backspace
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        });
        //Menampilkan password_edit
        $('#tampilkan_password_anggota_edit').click(function(){
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