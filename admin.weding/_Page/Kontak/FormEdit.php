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
        //Tangkap id_kontak
        if(empty($_POST['id_kontak'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center">';
            echo '      <small class="text-danger">ID Anggota Tidak Boleh Kosong!</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_kontak=$_POST['id_kontak'];
            $id_kontak=validateAndSanitizeInput($id_kontak);
            //Buka Informasi
            $uid_kontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'uid_kontak');
            $nama=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'nama');
            $email=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'email');
            $kontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'kontak');
            $kategori=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'kategori');
            $alamat=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'alamat');
            $sudah_dihubungi=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'sudah_dihubungi');
?>
    <input type="hidden" name="id_kontak" value="<?php echo $id_kontak; ?>">
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
            <label for="kontak_edit">Kontak (WA)</label>
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
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="alamat_edit">Alamat</label>
        </div>
        <div class="col-md-8">
            <textarea name="alamat" id="alamat_edit" class="form-control"><?php echo $alamat; ?></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="kategori_edit">Kategori</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kategori" id="kategori_edit" class="form-control" list="ListKategoriEdit" value="<?php echo $kategori; ?>">
            <datalist id="ListKategoriEdit">
                <?php
                    $QryKategori = mysqli_query($Conn, "SELECT kategori FROM kontak ORDER BY kategori ASC");
                    while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                        $kategori= $DataKategori['kategori'];
                        echo '<option value="'.$kategori.'">'.$kategori.'</option>';
                    }
                ?>
            </datalist>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="sudah_dihubungi_edit">Status Dihubungi</label>
        </div>
        <div class="col-md-8">
            <select name="sudah_dihubungi" id="sudah_dihubungi_edit" class="form-control">
                <option <?php if($sudah_dihubungi=="Belum"){echo "selected";} ?> value="Belum">Belum</option>
                <option <?php if($sudah_dihubungi=="Sudah"){echo "selected";} ?> value="Sudah">Sudah</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <small class="credit">
                <code class="text-primary">Pastikan data kontak yang anda input sudah benar</code>
            </small>
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
    </script>
<?php 
        }
    }
?>