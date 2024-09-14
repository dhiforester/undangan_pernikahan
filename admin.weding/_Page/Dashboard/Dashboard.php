<?php
    //Jumlah Kontak
    $JumlahKontak = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak"));
    $JumlahkontakFormat = "" . number_format($JumlahKontak,0,',','.');
    //Jumlah Kontak Yang Sudah Dihubungi
    $JumlahKontakDihubungi = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak WHERE sudah_dihubungi='1'"));
    $JumlahKontakDihubungiFormat = "" . number_format($JumlahKontakDihubungi,0,',','.');
    //Jumlah Kontak Belum Dihubungi
    $JumlahKontakBelumDihubungi = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak WHERE sudah_dihubungi='0'"));
    $JumlahKontakBelumDihubungiFormat = "" . number_format($JumlahKontakBelumDihubungi,0,',','.');
    //Jumlah Yang Akan Hadir
    $JumlahYangAkanHadir = mysqli_num_rows(mysqli_query($Conn, "SELECT id_attended FROM attended"));
    $JumlahYangAkanHadirFormat = "" . number_format($JumlahYangAkanHadir,0,',','.');
    include "_Page/Dashboard/ProsesHitungAktivitas.php";
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col col-md-3">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Kontak</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-bookmark"></i>
                                </div>
                                <div class="ps-3">
                                    <?php
                                        echo '  <span class="text-muted small pt-1 fw-bold">'.$JumlahkontakFormat.'</span><br>';
                                        echo '  <span class="text-muted small pt-2 ps-1">Record</span>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Kontak Dihubungi</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-bookmark"></i>
                                </div>
                                <div class="ps-3">
                                    <?php
                                        echo '  <span class="text-muted small pt-1 fw-bold">'.$JumlahKontakDihubungiFormat.'</span><br>';
                                        echo '  <span class="text-muted small pt-2 ps-1">Record</span>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Kontak Belum Dihubungi</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-bookmark"></i>
                                </div>
                                <div class="ps-3">
                                    <?php
                                        echo '  <span class="text-muted small pt-1 fw-bold">'.$JumlahKontakBelumDihubungiFormat.'</span><br>';
                                        echo '  <span class="text-muted small pt-2 ps-1">Record</span>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Calon Tamu</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-bookmark"></i>
                                </div>
                                <div class="ps-3">
                                    <?php
                                        echo '  <span class="text-muted small pt-1 fw-bold">'.$JumlahYangAkanHadirFormat.'</span><br>';
                                        echo '  <span class="text-muted small pt-2 ps-1">Orang</span>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Reports -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title">
                                Aktivitas Sistem <span class="text-grayish">(Periode <?php echo date ('F Y'); ?>)</span>
                            </b>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" id="NamaTitleData"></h5>
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
