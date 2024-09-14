<?php
    $UrlFotoProfile='assets/img/User/'.$SessionGambar.'';
    $nama_akses=GetDetailData($Conn,'akses','id_akses',$SessionIdAkses,'nama');
    $email_akses=GetDetailData($Conn,'akses','id_akses',$SessionIdAkses,'email');
    $image_akses=GetDetailData($Conn,'akses','id_akses',$SessionIdAkses,'foto');
    $datetime_update=GetDetailData($Conn,'akses','id_akses',$SessionIdAkses,'datetime_update');
    $JumlahAktivitas =mysqli_num_rows(mysqli_query($Conn, "SELECT id_akses FROM log WHERE id_akses='$SessionIdAkses'"));
?>
<section class="section dashboard">
    <div class="row mb-3">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman profil yang digunakan untuk mengelola informasi akses anda.';
                echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 mb-3">
                            <b class="card-title">
                                Informasi Pengguna
                            </b>
                        </div>
                        <div class="col-md-2 mb-3">
                            <a class="btn btn-md btn-outline-dark btn-rounded btn-block" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i> Option
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalUbahIdentitasProfil">
                                        <i class="bi bi-pencil me-1 text-primary"></i> 
                                        <small class="credit">Ubah Informasi</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalUbahFotoProfil">
                                        <i class="bi bi-image me-1 text-primary"></i> 
                                        <small class="credit">Ubah Foto Profil</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalUbahPasswordProfil">
                                        <i class="bi bi-key me-1 text-primary"></i> 
                                        <small class="credit">Ubah Password</small>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col col-md-3 text-center mb-4">
                            <img src="<?php echo "$UrlFotoProfile"; ?>" alt="" width="60%" class="rounded-circle">
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col col-md-6">
                                    Nama Lengkap
                                </div>
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-grayish"><?php echo "$nama_akses"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-6">Alamat Email</div>
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-grayish"><?php echo "$email_akses"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-6">Update Terakhir</div>
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-grayish"><?php echo "$datetime_update"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-6">Jumlah Aktivitas</div>
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-grayish"><?php echo "$JumlahAktivitas"; ?></code>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
