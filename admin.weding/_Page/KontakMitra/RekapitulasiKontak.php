<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    if(empty($SessionIdAkses)){
        echo '<div class="card">';
        echo '  <div class="card-body text-center text-danger">';
        echo '      Sessi Akses Sudah Berakhir, Silahkan Login Ulang!';
        echo '  </div>';
        echo '</div>';
    }else{
        //Menghitung Jumlah
        $JumlahKontak=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak"));
        $JumlahSeluruhKontak=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE id_mitra='$SessionIdAkses'"));
        $JumlahKontakTerdistribusi=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE id_mitra='$SessionIdAkses' AND id_anggota!='0'"));
        $JumlahKontakDihubungi=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE id_mitra='$SessionIdAkses' AND sudah_dihubungi='1'"));
        $PersentaseKontak=($JumlahSeluruhKontak/$JumlahKontak)*100;
        $PersentaseKontakTerdistribusi=($JumlahKontakTerdistribusi/$JumlahKontak)*100;
        $PersentaseJumlahKontakDihubungi=($JumlahKontakDihubungi/$JumlahKontak)*100;
        $PersentaseKontak=round($PersentaseKontak);
        $PersentaseKontakTerdistribusi=round($PersentaseKontakTerdistribusi);
        $PersentaseJumlahKontakDihubungi=round($PersentaseJumlahKontakDihubungi);

        $JumlahSeluruhKontakFormat=formatAngkaRibuJutaan($JumlahSeluruhKontak);
        $JumlahKontakFormat=formatAngkaRibuJutaan($JumlahKontak);
        $JumlahKontakTerdistribusiFormat=formatAngkaRibuJutaan($JumlahKontakTerdistribusi);
        $JumlahKontakDihubungiFormat=formatAngkaRibuJutaan($JumlahKontakDihubungi);
?>
    <div class="card">
        <div class="card-header text-center">
            <b class="card-title">Rekapitulasi Kontak</b>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6 text-center">
                    <span>Total Kontak</span>
                    <h2><?php echo "$JumlahSeluruhKontakFormat"; ?></h2>
                    <small class="credit">
                        <code class="text text-grayish">Dataset</code>
                    </small>
                </div>
                <div class="col-md-6 text-center">
                    <span>Persentase</span>
                    <h2><?php echo "$PersentaseKontak %"; ?></h2>
                    <small class="credit">
                        <code class="text text-grayish">Dari Total <?php echo "$JumlahKontakFormat"; ?></code>
                    </small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <span>Terdistribusi</span>
                </div>
                <div class="col-md-8">
                    <div class="progress_2" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo "$JumlahKontakTerdistribusi"; ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress_2-bar" style="width: <?php echo "$JumlahKontakTerdistribusi%"; ?>"><?php echo "$PersentaseKontakTerdistribusi %"; ?></div>
                    </div>
                    <small>
                        <code class="text text-grayish"><?php echo "$JumlahKontakTerdistribusiFormat"; ?> Kontak</code>
                    </small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <span>Dihubungi</span>
                </div>
                <div class="col-md-8">
                    <div class="progress_2" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo "$PersentaseJumlahKontakDihubungi"; ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress_2-bar" style="width: <?php echo "$PersentaseJumlahKontakDihubungi%"; ?>"><?php echo "$PersentaseJumlahKontakDihubungi %"; ?></div>
                    </div>
                    <small>
                        <code class="text text-grayish"><?php echo "$JumlahKontakDihubungiFormat Kontak"; ?></code>
                    </small>
                </div>
            </div>
        </div>
    </div>
<?php } ?>