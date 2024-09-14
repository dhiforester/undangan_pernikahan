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
            $id_anggota=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'id_anggota');
            $email=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'email');
            $nama=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'nama');
            $kontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'kontak');
            $sumber=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'sumber');
            $sudah_dihubungi=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'sudah_dihubungi');
            if($sudah_dihubungi==1){
                $LabelSudahDihubungi='<code class="badge bg-success">Sudah</code>';
            }else{
                $LabelSudahDihubungi='<code class="badge bg-danger">Belum</code>';
            }
            //Buka Nama Anggota
            if(empty($id_anggota)){
                $NamaAnggota='<code class="text-danger">None</code>';
            }else{
                $NamaAnggota=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'nama');
                $NamaAnggota='<code class="text-grayish">'.$NamaAnggota.'</code>';
            }
            //Buka email
            if(empty($email)){
                $EmailLabel='<code class="text-danger">None</code>';
            }else{
                $EmailLabel='<code class="text-grayish">'.$email.'</code>';
            }
            //Buka sumber
            if(empty($sumber)){
                $LabelSumber='<code class="text-danger">None</code>';
            }else{
                $LabelSumber='<code class="text-grayish">'.$sumber.'</code>';
            }
?>
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
        <div class="col col-md-4">Sumber</div>
        <div class="col col-md-8">
            <?php echo $LabelSumber; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Status Dihubungi</div>
        <div class="col col-md-8">
            <?php echo $LabelSudahDihubungi; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Customer Service</div>
        <div class="col col-md-8">
            <?php echo $NamaAnggota; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Datetime</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $datetime_import; ?></code>
        </div>
    </div>
<?php 
        }
    }
?>