<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman untuk melakukan distribusi kontak ke masing-masing <i>Customer Service</i>.';
                echo '  Anda bisa membagikan data kontak secara masal dalam sekali proses dengan mudah.<br>';
                echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
                $KontakCs = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak WHERE id_anggota!='0'"));
                $BelumDihubungi = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak WHERE sudah_dihubungi='0'"));
                $AnggotaAktif = mysqli_num_rows(mysqli_query($Conn, "SELECT id_anggota FROM anggota WHERE status='Aktif'"));
                $RataRataCs=$BelumDihubungi/$AnggotaAktif;
                $RataRataCs=round($RataRataCs);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="RekapDistribusi">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <form action="javascript:void(0);" id="ProsesDistribusi">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d'); ?>">
                                <label for="tanggal"><small class="credit">Periode Distribusi</small></label>
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control" name="per_cs" id="per_cs" value="<?php echo $RataRataCs; ?>">
                                <label for="per_cs"><small class="credit">Kontak/CS</small></label>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button type="submit" class="btn btn-md btn-primary btn-block">
                                    <i class="bi bi-arrow-return-right"></i> Mulai
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table table-responsive scroll_div">
                            <table class="table table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <td class="text-center">
                                            <b>Nama</b>
                                        </td>
                                        <td class="text-left">
                                            <b>Email</b>
                                        </td>
                                        <td class="text-center">
                                            <b>Jmlh Kontak</b>
                                        </td>
                                        <td class="text-center">
                                            <b>Status</b>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody id="HasilDistribusi">
                                    <tr>
                                        <td colspan="4" class="text-center" id="NotifikasiProsesBatch">Belum Ada Data Yang Diproses</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal" data-bs-target="#ModalHapusAnggotaDariKontak">
                        <code><i class="bi bi-x"></i> Hapus CS dari Kontak</code>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-center">
                    <b class="card-title">Riwayat Distribusi</b>
                </div>
                <div class="card-body" id="MenampilkanRiwayatDistribusi">

                </div>
            </div>
        </div>
    </div>
</section>