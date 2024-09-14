<form action="javascript:void(0);" id="ProsesTambahTransaksi" autocomplete="off">
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman form tambah data transaksi.';
                    echo '  Silahkan masukan informasi pelanggan, produk dan pengiriman secara lengkap dan jelas sesuai informasi order.';
                    echo '  Pastikan kembali bahwa nilai dan harga pada item produk sudah sesuai.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <form action="javascript:void(0);" id="ProsesTambahTransaksi">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9 mb-3">
                                    <b class="card-title">Form Transaksi/Order</b>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="index.php?Page=Transaksi" class="btn btn-dark btn-rounded btn-block">
                                        <i class="bi bi-chevron-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12 mb-3">
                                    <b>Informasi Pelanggan</b>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="nama">Nama Customer</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="nama" id="nama" class="form-control">
                                        <button type="button" class="btn btn-info">
                                            <i class="bi bi-person-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="kontak">No.Kontak</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="kontak" id="kontak" class="form-control" placeholder="62">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="alamat">Alamat</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="alamat" id="alamat" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="provinsi">Provinsi</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="provinsi" id="provinsi" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="kabupaten">Kabupaten</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="kabupaten" id="kabupaten" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="kecamatan">Kecamatan</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="kecamatan" id="kecamatan" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="desa">Kabupaten</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="desa" id="desa" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="kode_pos">Kode POS</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="kode_pos" id="kode_pos" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 mb-3">
                                    <b>Informasi Produk/Barang</b>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="nama_produk">Nama Produk/Barang</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="berat">Berat (Kg)</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="number" name="berat" id="berat" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="harga_non_cod">Harga Non COD</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="number" name="harga_non_cod" id="harga_non_cod" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="harga_cod">Harga COD</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="number" name="harga_cod" id="harga_cod" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="qty">Quantity</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="number" name="qty" id="qty" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="keterangan">Instruksi Pengiriman</label>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <input type="text" name="keterangan" id="keterangan" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Produk</b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">Nama CS</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionNama"; ?></small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionEmailAkses"; ?></small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Kontak</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionKontakAkses"; ?></small></div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Customer Service</b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">Nama CS</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionNama"; ?></small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionEmailAkses"; ?></small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Kontak</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionKontakAkses"; ?></small></div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Supervisi</b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">Nama CS</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionNama"; ?></small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionEmailAkses"; ?></small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Kontak</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionKontakAkses"; ?></small></div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Mitra</b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">Nama CS</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionNama"; ?></small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionEmailAkses"; ?></small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Kontak</div>
                            <div class="col-md-8"><small class="credit text-grayish"><?php echo "$SessionKontakAkses"; ?></small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Simpan Transaksi</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                Pastikan data yang anda input sudah sesuai.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3" id="NotifikasiTambahTransaksi">
                                <!-- Notifikasi Tambah Transaksi Akan Muncul Disini -->
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-md btn-rounded btn-primary">
                                    <i class="bi bi-save"></i> Simpan Transaksi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>