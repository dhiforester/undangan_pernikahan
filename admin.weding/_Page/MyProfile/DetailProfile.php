<?php
    if($SessionKategoriAkses=="Admin"){
        $UrlFotoProfile='assets/img/User/'.$SessionGambar.'';
    }else{
        if($SessionKategoriAkses=="Anggota"){
            $UrlFotoProfile='assets/img/Anggota/'.$SessionGambar.'';
        }else{
            $UrlFotoProfile='assets/img/User/'.$SessionGambar.'';
        }
    }
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
                    <b class="card-title">
                        Informasi Pengguna
                    </b>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col col-md-3 text-center mb-4">
                            <img src="<?php echo "$UrlFotoProfile"; ?>" alt="" width="70%" class="rounded-circle">
                            <p>

                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col col-md-6">
                                    Nama Lengkap
                                </div>
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-grayish"><?php echo "$SessionNama"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-6">Kontak</div>
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-grayish"><?php echo "$SessionKontakAkses"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-6">Email</div>
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-grayish"><?php echo "$SessionEmailAkses"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-6">Level Akses</div>
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-grayish"><?php echo "$SessionKategoriAkses"; ?></code>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <?php if($SessionKategoriAkses=="Admin"){?>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <a href="javascript:void(0);" class="text-dark"  data-bs-toggle="modal" data-bs-target="#ModalUbahIdentitasProfil">
                                                    <i class="bi bi-pencil me-1 text-primary"></i> 
                                                    <small class="credit">Ubah Identitias</small>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="javascript:void(0);" class="text-dark" data-bs-toggle="modal" data-bs-target="#ModalUbahFotoProfil">
                                                    <i class="bi bi-image me-1 text-primary"></i> 
                                                    <small class="credit">Ubah Foto Profil</small>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="javascript:void(0);" class="text-dark" data-bs-toggle="modal" data-bs-target="#ModalUbahPasswordProfil">
                                                    <i class="bi bi-key me-1 text-primary"></i> 
                                                    <small class="credit">Ubah Password</small>
                                                </a>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
