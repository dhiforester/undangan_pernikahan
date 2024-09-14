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
            //Hitung Jumlah Kontak
            $JumlahKontak = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak WHERE id_mitra='$id_mitra'"));
            $JumlahLog = mysqli_num_rows(mysqli_query($Conn, "SELECT id_mitra_log FROM mitra_log WHERE id_mitra='$id_mitra'"));
            $JumlahTransaksi = mysqli_num_rows(mysqli_query($Conn, "SELECT id_transaksi FROM transaksi WHERE id_mitra='$id_mitra'"));
?>
    <div class="row">
        <div class="col-md-4 mb-3 text-center">
            <img src="assets/img/Mitra/<?php echo $foto; ?>" alt="" width="90%" class="img-circle rounded-circle">
        </div>
        <div class="col-md-8 mb-3">
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
            <div class="row mb-3">
                <div class="col col-md-4">Kontak</div>
                <div class="col col-md-8">
                    <code class="text text-grayish"><?php echo "$JumlahKontak Data"; ?></code>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-md-4">Upload</div>
                <div class="col col-md-8">
                    <code class="text text-grayish"><?php echo "$JumlahLog Kali"; ?></code>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-md-4">Closing</div>
                <div class="col col-md-8">
                    <code class="text text-grayish"><?php echo "$JumlahTransaksi Transaksi"; ?></code>
                </div>
            </div>
        </div>
    </div>
<?php 
        }
    }
?>