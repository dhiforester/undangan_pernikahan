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
            $harga_format = "Rp " . number_format($harga,0,',','.');
?>
            <div class="row mb-3">
                <div class="col col-md-6">Kode Barang</div>
                <div class="col col-md-6">
                    <code class="text text-grayish"><?php echo $kode; ?></code>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-md-6">Nama/Merek</div>
                <div class="col col-md-6">
                    <code class="text text-grayish"><?php echo $nama; ?></code>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-md-6">Kategori</div>
                <div class="col col-md-6">
                    <code class="text text-grayish"><?php echo $kategori; ?></code>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-md-6">Harga</div>
                <div class="col col-md-6">
                    <code class="text text-grayish"><?php echo $harga_format; ?></code>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-md-6">Stok/Satuan</div>
                <div class="col col-md-6">
                    <code class="text text-grayish"><?php echo "$stok $satuan"; ?></code>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-md-6">Berat (Kg)</div>
                <div class="col col-md-6">
                    <code class="text text-grayish"><?php echo "$berat Kg"; ?></code>
                </div>
            </div>
<?php 
        } 
    } 
?>