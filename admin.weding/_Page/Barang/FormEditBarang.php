<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Session.php";
    if(empty($SessionIdAkses)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center">';
        echo '      <small class="text-danger">Sesi Akses Sudah Berakhir, Silahkan Login Ulang</small>';
        echo '  </div>';
        echo '</div>';
    }else{
        //Tangkap id_barang
        if(empty($_POST['id_barang'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center">';
            echo '      <small class="text-danger">ID Barang Tidak Boleh Kosong!</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_barang=$_POST['id_barang'];
            $id_barang=validateAndSanitizeInput($id_barang);
            //Buka Informasi
            $kode=GetDetailData($Conn,'barang','id_barang',$id_barang,'kode');
            $nama=GetDetailData($Conn,'barang','id_barang',$id_barang,'nama');
            $kategori=GetDetailData($Conn,'barang','id_barang',$id_barang,'kategori');
            $stok=GetDetailData($Conn,'barang','id_barang',$id_barang,'stok');
            $harga=GetDetailData($Conn,'barang','id_barang',$id_barang,'harga');
            $satuan=GetDetailData($Conn,'barang','id_barang',$id_barang,'satuan');
            $berat=GetDetailData($Conn,'barang','id_barang',$id_barang,'berat');
            $harga_format = "" . number_format($harga,0,',','.');
            $stok_format = "" . number_format($stok,0,',','.');
?>
            <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="kode_edit">Kode Barang</label>
                </div>
                <div class="col-md-8">
                    <input type="text" name="kode" id="kode_edit" class="form-control" value="<?php echo $kode; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="nama_edit">Nama Barang</label>
                </div>
                <div class="col-md-8">
                    <input type="text" name="nama" id="nama_edit" class="form-control" value="<?php echo $nama; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="kategori_edit">Kategori</label>
                </div>
                <div class="col-md-8">
                    <input type="text" name="kategori" id="kategori_edit" list="ListKategori" class="form-control" value="<?php echo $kategori; ?>">
                    <datalist id="ListKategori">
                        <?php
                            $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM barang ORDER BY kategori ASC");
                            while ($data = mysqli_fetch_array($query)) {
                                $kategori= $data['kategori'];
                                echo '  <option value="'.$kategori.'">';
                            }
                        ?>
                    </datalist>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="harga_edit">Harga (Rp)</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="harga" id="harga_edit" class="form-control format_uang" value="<?php echo $harga_format; ?>">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="stok_edit">Stok</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="stok" id="stok_edit" class="form-control format_uang" value="<?php echo $stok_format; ?>">
                        <input type="text" name="satuan" id="satuan" list="ListSatuan" class="form-control" placeholder="Satuan" value="<?php echo $satuan; ?>">
                        <datalist id="ListSatuan">
                            <?php
                                $query = mysqli_query($Conn, "SELECT DISTINCT satuan FROM barang ORDER BY satuan ASC");
                                while ($data = mysqli_fetch_array($query)) {
                                    $satuan= $data['satuan'];
                                    echo '  <option value="'.$satuan.'">';
                                }
                            ?>
                        </datalist>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="berat_edit">Berat (Kg)</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <input type="text" name="berat" id="berat_edit" class="form-control" placeholder="00.00" value="<?php echo $berat; ?>">
                        <span class="input-group-text">Kg</span>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <small class="credit">Pastikan data barang yang anda input sudah sesuai</small>
                </div>
            </div>
            <script>
                $( '.format_uang' ).mask('000.000.000.000', {reverse: true});
                $('#berat_edit').on('input', function() {
                    // Ambil nilai dari input
                    var value = $(this).val();
                    // Gunakan regex untuk membatasi input hanya pada angka dan desimal dengan 2 angka setelah koma
                    var valid = value.match(/^\d+(\.\d{0,2})?$/);
                    if (valid) {
                        // Jika input valid, biarkan nilai tetap
                        $(this).val(value);
                    } else {
                        // Jika input tidak valid, hapus karakter terakhir
                        $(this).val(value.slice(0, -1));
                    }
                });
            </script>
<?php 
        } 
    } 
?>