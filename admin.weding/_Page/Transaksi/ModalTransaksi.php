<div class="modal fade" id="ModalFilter" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesFilter">
                <input type="hidden" name="page" id="page">
                <div class="modal-header">
                    <h5 class="modal-title text-info">
                        <i class="bi bi-funnel"></i> Filter Transaksi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col col-md-4"><label for="batas">Limit/Batas</label></div>
                        <div class="col col-md-8 text-center">
                            <select name="batas" id="batas" class="form-control">
                                <option value="5">5</option>
                                <option selected value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-4"><label for="OrderBy">Mode Urutan</label></div>
                        <div class="col col-md-8 text-center">
                            <select name="OrderBy" id="OrderBy" class="form-control">
                                <option value="">Pilih</option>
                                <option value="datetime_transaksi">Tanggal</option>
                                <option value="id_supervisi">Supervisi</option>
                                <option value="status_pembayaran">Status Pembayaran</option>
                                <option value="status_pengiriman">Status Pengiriman</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-4"><label for="ShortBy">Tipe Urutan</label></div>
                        <div class="col col-md-8 text-center">
                            <select name="ShortBy" id="ShortBy" class="form-control">
                                <option value="DESC">Z To A</option>
                                <option value="ASC">A To Z</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-4"><label for="keyword_by">Dasar Pencarian</label></div>
                        <div class="col col-md-8 text-center">
                            <select name="keyword_by" id="keyword_by" class="form-control">
                                <option value="">Pilih</option>
                                <option value="datetime_transaksi">Tanggal</option>
                                <option value="id_supervisi">Supervisi</option>
                                <option value="status_pembayaran">Status Pembayaran</option>
                                <option value="status_pengiriman">Status Pengiriman</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-4"><label for="keyword">Kata Kunci</label></div>
                        <div class="col col-md-8 text-center" id="FormFilter">
                            <input type="text" name="keyword" id="keyword" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-close"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalTambah" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light"><i class="bi bi-plus"></i> Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        Untuk menambah transaksi secara manual oleh admin, anda akan diarahkan ke halaman form khusus transaksi untuk melengkapi informasi order.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="index.php?Page=Transaksi&Sub=TambahTransaksi" class="btn btn-md btn-rounded btn-success">
                    Lanjutkan <i class="bi bi-chevron-right"></i>
                </a>
                <button type="button" class="btn btn-outline-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalDetail" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">
                    <i class="bi bi-info-circle"></i> Detail Transaksi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="FormDetail">
                        <!-- Detail Transaksi Akan Muncul Disini -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalHapus" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapus">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Hapus Transaksi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="FormHapus">
                            <!-- Form Hapus Transaksi Akan Muncul Disini -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" id="NotifikasiHapus">
                            <!-- Notifikasi Hapus Transaksi Akan Muncul Disini -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-check"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalTambahJurnal" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahJurnal">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-plus"></i> Tambah Jurnal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormTambahJurnal"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="NotifikasiTambahJurnal"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEditJurnal" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditJurnal">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit Jurnal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormEditJurnal"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center" id="NotifikasiEditJurnal"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalHapusJurnal" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusJurnal">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-trash"></i> Hapus Jurnal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12" id="FormHapusJurnal"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiHapusJurnal"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-check"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tidak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalExport" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="_Page/Transaksi/ProsesExportTransaksi.php" method="POST" target="_blank">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-download"></i> Export Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col col-md-4">
                            <label for="tahun">Tahun</label>
                        </div>
                        <div class="col col-md-8">
                            <input type="number" min="1" name="tahun" id="tahun" class="form-control" value="<?php echo date('Y'); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-4">
                            <label for="bulan">Bulan</label>
                        </div>
                        <div class="col col-md-8">
                            <select name="bulan" id="bulan" class="form-control">
                                <?php
                                // Array nama bulan dalam bahasa Indonesia
                                $namaBulan = [
                                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                                ];

                                // Loop untuk menampilkan opsi ke dalam select
                                foreach ($namaBulan as $index => $bulan) {
                                    // Format value menjadi dua digit, misalnya "01", "02", dll.
                                    $value = str_pad($index + 1, 2, "0", STR_PAD_LEFT);
                                    if($value==date('m')){
                                        echo "<option selected value=\"$value\">$bulan</option>";
                                    }else{
                                        echo "<option value=\"$value\">$bulan</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-4">
                            <label for="type_file">Type Data</label>
                        </div>
                        <div class="col col-md-8">
                            <select name="type_file" id="type_file" class="form-control">
                                <option value="HTML">HTML</option>
                                <option value="PDF">PDF</option>
                                <option value="CSV">CSV/Excel</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-save"></i> Filter
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
