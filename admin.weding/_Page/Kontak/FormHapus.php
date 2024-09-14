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
            if($sudah_dihubungi=="Sudah"){
                $LabelSudahDihubungi='<code class="badge bg-success">Sudah</code>';
            }else{
                $LabelSudahDihubungi='<code class="badge bg-danger">Belum</code>';
            }
            //Buka kontak
            if(empty($kontak)){
                $LabelKontak='<code class="text-danger">None</code>';
            }else{
                $LabelKontak='<code class="text-grayish">'.$kontak.'</code>';
            }
            //Buka email
            if(empty($email)){
                $LabelEmail='<code class="text-danger">None</code>';
            }else{
                $LabelEmail='<code class="text-grayish">'.$email.'</code>';
            }
            //Buka alamat
            if(empty($alamat)){
                $LabelAlamat='<code class="text-danger">None</code>';
            }else{
                $LabelAlamat='<code class="text-grayish">'.$alamat.'</code>';
            }
            //Buka kategori
            if(empty($kategori)){
                $LabelKategori='<code class="text-danger">None</code>';
            }else{
                $LabelKategori='<code class="text-grayish">'.$kategori.'</code>';
            }
?>
    <input type="hidden" name="id_kontak" value="<?php echo $id_kontak; ?>">
    <div class="row mb-3">
        <div class="col col-md-4">UUID Kontak</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $uid_kontak; ?></code>
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
            <code class="text text-grayish"><?php echo $LabelKontak; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Email</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $LabelEmail; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Alamat</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $LabelAlamat; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Kategori</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $kategori; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Status Dihubungi</div>
        <div class="col col-md-8">
            <?php echo $LabelSudahDihubungi; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-12 text-primary">
            Apakah anda yakin akan menghapus data ini?
        </div>
    </div>
<?php 
        }
    }
?>