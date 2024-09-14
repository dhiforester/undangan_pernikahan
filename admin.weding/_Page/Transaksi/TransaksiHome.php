<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman transaksi.';
                echo '  Anda bisa mencatat data transaksi sesuai referensi jenis transaksi yang sudah ada.';
                echo '  Anda juga bisa mencatat data transaksi sekaligus melakukan posting jurnal pada halaman ini.';
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
                        <div class="col-md-8 mb-3"></div>
                        <div class="col-md-2 mb-3">
                            <a class="btn btn-md btn-outline-dark btn-rounded btn-block" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i> Option
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li class="dropdown-header text-start">
                                    <h6>Option</h6>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalFilter">
                                        <i class="bi bi-funnel"></i> Filter
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalExport">
                                        <i class="bi bi-cloud-arrow-down"></i> Export
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2 mb-3">
                            <a class="btn btn-md btn-primary btn-rounded btn-block" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambah">
                                <i class="bi bi-plus"></i> Tambah
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="MenampilkanTabelTransaksi">

                </div>
            </div>
        </div>
    </div>
</section>