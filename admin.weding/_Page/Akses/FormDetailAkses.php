<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    //Harus Login Terlebih Dulu
    if(empty($SessionIdAkses)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center">';
        echo '      <code>Sesi Login Sudah Berakhir, Silahkan Login Ulang!</code>';
        echo '  </div>';
        echo '</div>';
    }else{
        //Tangkap id_akses
        if(empty($_POST['id_akses'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center">';
            echo '      <code>ID Akses Tidak Boleh Kosong</code>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_akses=$_POST['id_akses'];
            //Bersihkan Variabel
            $id_akses=validateAndSanitizeInput($id_akses);
            //Buka data askes
            $nama_akses=GetDetailData($Conn,'akses','id_akses',$id_akses,'nama');
            $email_akses=GetDetailData($Conn,'akses','id_akses',$id_akses,'email');
            $image_akses=GetDetailData($Conn,'akses','id_akses',$id_akses,'foto');
            $datetime_update=GetDetailData($Conn,'akses','id_akses',$id_akses,'datetime_update');
            //Jumlah
            $JumlahAktivitas =mysqli_num_rows(mysqli_query($Conn, "SELECT id_akses FROM log WHERE id_akses='$id_akses'"));
            //Format Tanggal
            $strtotime2=strtotime($datetime_update);
            //Menampilkan Tanggal
            $DateUpdate=date('d/m/Y H:i:s T', $strtotime2);
            if(!empty($image_akses)){
                $image_akses=$image_akses;
            }else{
                $image_akses="No-Image.png";
            }
?>
            <div class="row mb-3 border-1 border-bottom">
                <div class="col-md-12 text-center mb-4">
                    <img src="<?php echo $base_url; ?>/assets/img/User/<?php echo $image_akses; ?>" alt="" width="50%" class="rounded-circle">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 mb-4">
                    <div class="row mb-3">
                        <div class="col col-md-4">Nama Lengkap</div>
                        <div class="col col-md-8">
                            <code class="text text-grayish"><?php echo $nama_akses; ?></code>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-4">Email</div>
                        <div class="col col-md-8">
                            <code class="text text-grayish"><?php echo $email_akses; ?></code>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-4">Update</div>
                        <div class="col col-md-8">
                            <code class="text text-grayish"><?php echo $DateUpdate; ?></code>
                        </div>
                    </div>
                </div>
            </div>
<?php 
        } 
    } 
?>