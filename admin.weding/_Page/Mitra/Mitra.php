<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman kelola data mitra.';
                echo '  Anda bisa menambahkan data mitra dan menambahkan akses mitra agar bisa masuk menggunakan aplikasi.';
                echo '  Anda bisa melihat riwayat masing-masing kinerja mitra dalam pemanfaatan data kontak yang dimilikinya .';
                echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 mb-3">

                        </div>
                        <div class="col-md-2 mb-3">
                            <button type="button" class="btn btn-md btn-outline-dark btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilter" title="Filter Data Mitra">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                        </div>
                        <div class="col-md-2 mb-3">
                            <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambah" title="Tambah Data Mitra">
                                <i class="bi bi-plus-lg"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="MenampilkanTabelMitra">

                </div>
            </div>
        </div>
    </div>
</section>