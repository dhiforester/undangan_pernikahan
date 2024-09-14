<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman kelola data barang.';
                echo '  Anda bisa menambahkan data barang, kelola stok, harga dan berat masing-masing item.';
                echo '  Data barang ini digunakan sebagai dasar dalam transaksi.';
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
                            <button type="button" class="btn btn-md btn-outline-dark btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilter" title="Filter Data Barang">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                        </div>
                        <div class="col-md-2 mb-3">
                            <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahBarang" title="Tambah Data Barang">
                                <i class="bi bi-plus-lg"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="MenampilkanTabelBarang">

                </div>
            </div>
        </div>
    </div>
</section>