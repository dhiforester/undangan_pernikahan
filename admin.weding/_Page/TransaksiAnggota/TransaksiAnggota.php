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
                    if(!empty($_GET['id'])){
                        $id_kontak=$_GET['id'];
                        $nama=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'nama');
                        $kontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'kontak');
                    }else{
                        $nama="";
                        $kontak="";
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <form action="javascript:void(0);" id="ProsesTambahTransaksi">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <b class="card-title">Transaksi/Order</b>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12 mb-3">
                                    <b>Informasi Pelanggan</b>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="nama">Nama Pelanggan/Penerima</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $nama; ?>">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="alamat">Alamat Pengiriman</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" name="provinsi" id="provinsi" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <input type="text" name="kabupaten" id="kabupaten" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" name="kecamatan" id="kecamatan" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="desa">Desa/Kelurahan</label>
                                    <input type="text" name="desa" id="desa" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kode_pos">Kode Pos</label>
                                    <input type="text" name="kode_pos" id="kode_pos" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_kontak">Nomor Kontak</label>
                                    <input type="text" name="no_kontak" id="no_kontak" class="form-control" value="<?php echo $kontak; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 mb-3">
                                    <b>Informasi Produk/Barang</b>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="nama_produk">Nama Produk/Barang</label>
                                    <input type="text" name="nama_produk" id="nama_produk" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="berat">Berat (Kg)</label>
                                    <input type="number" name="berat" id="berat" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="harga_non_cod">Harga Barang (Jika Non-COD)</label>
                                    <input type="number" name="harga_non_cod" id="harga_non_cod" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="harga_cod">Nilai COD (Jika COD)</label>
                                    <input type="text" name="harga_cod" id="harga_cod" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="qty" id="qty" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="keterangan">Instruksi Pengiriman</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <small class="credit">
                                        Pastikan informasi order/transaksi sudah sesuai
                                    </small>
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
                </form>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">Informasi Customer Service</b>
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
                        <b class="card-title">Riwayat Transaksi</b>
                    </div>
                    <div class="card-body" id="ListRiwayatTransaksi">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>