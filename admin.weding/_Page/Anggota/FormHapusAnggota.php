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
            //Buka Informasi
            $id_supervisi=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'id_supervisi');
            $email=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'email');
            $nama=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'nama');
            $password=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'password');
            $kontak=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'kontak');
            $foto=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'foto');
            $status=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'status');
            if(empty($foto)){
                $foto="No-Image.PNG";
            }else{
                $foto=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'foto');
            }
            $NamaSupervisi=GetDetailData($Conn,'supervisi','id_supervisi',$id_supervisi,'nama');
            if($status=="Keluar"){
                $LabelStatus='<span class="badge bg-danger">Keluar</span>';
            }else{
                $LabelStatus='<span class="badge bg-success">Aktif</span>';
            }
?>
    <input type="hidden" name="id_anggota" value="<?php echo "$id_anggota"; ?>">
    <div class="row mb-3">
        <div class="col col-md-4">Nama</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $nama; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Supervisi</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $NamaSupervisi; ?></code>
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
    <div class="row mb-3">
        <div class="col col-md-4">Status</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $LabelStatus; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-12 text-center text-primary">
            Apakah anda yakin akan menghapus data ini?
        </div>
    </div>
<?php 
        }
    }
?>