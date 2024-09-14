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
            $datetime_import=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'datetime_import');
            $id_mitra=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'id_mitra');
            $id_anggota=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'id_anggota');
            $email=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'email');
            $nama=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'nama');
            $kontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'kontak');
            $sumber=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'sumber');
            $sudah_dihubungi=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'sudah_dihubungi');
?>
    <input type="hidden" name="id_kontak" value="<?php echo $id_kontak; ?>">
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="nama_edit">Nama</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nama" id="nama_edit" class="form-control" value="<?php echo $nama; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="kontak_edit">Kontak</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kontak" id="kontak_edit" class="form-control" placeholder="62" value="<?php echo $kontak; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="sumber_edit">Sumber/Mitra</label>
        </div>
        <div class="col-md-8">
            <select name="id_mitra" id="id_mitra" class="form-control">
                <option value="">Pilih</option>
                <?php
                    $query_mitra = mysqli_query($Conn, "SELECT id_mitra, nama FROM mitra ORDER BY nama ASC");
                    while ($data_mitra = mysqli_fetch_array($query_mitra)) {
                        $id_mitra_list= $data_mitra['id_mitra'];
                        $nama_list= $data_mitra['nama'];
                        if($id_mitra_list==$id_mitra){
                            echo '<option selected value="'.$id_mitra_list.'">'.$nama_list.'</option>';
                        }else{
                            echo '<option value="'.$id_mitra_list.'">'.$nama_list.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="sudah_dihubungi_edit">Status Dihubungi</label>
        </div>
        <div class="col-md-8">
            <select name="sudah_dihubungi" id="sudah_dihubungi_edit" class="form-control">
                <option <?php if($sudah_dihubungi=="1"){echo "selected";} ?> value="1">Sudah</option>
                <option <?php if(empty($sudah_dihubungi)){echo "selected";} ?> value="0">Belum</option>
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