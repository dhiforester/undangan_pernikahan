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
        //Tangkap id_transaksi
        if(empty($_POST['id_transaksi'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center">';
            echo '      <small class="text-danger">ID Transaksi Tidak Boleh Kosong!</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_transaksi=$_POST['id_transaksi'];
            //Bersihkan Variabel
            $id_transaksi=validateAndSanitizeInput($id_transaksi);
            //Buka Informasi
            $uuid_transaksi=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'uuid_transaksi');
            $id_supervisi=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'id_supervisi');
            $id_anggota=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'id_anggota');
            $id_kontak=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'id_kontak');
            $datetime_transaksi=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'datetime_transaksi');
            $rincian_transaksi=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'rincian_transaksi');
            $rincian_pengiriman=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'rincian_pengiriman');
            $subtotal=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'subtotal');
            $ppn=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'ppn');
            $jumlah=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'jumlah');
            $status_pembayaran=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'status_pembayaran');
            $status_pengiriman=GetDetailData($Conn,'transaksi','id_transaksi',$id_transaksi,'status_pengiriman');
            //Format Angka
            if(empty($jumlah)){
                $jumlah=0;
            }
            if(empty($subtotal)){
                $subtotal=0;
            }
            if(empty($ppn)){
                $ppn=0;
            }
            $JumlahFormat = "" . number_format($jumlah,0,',','.');
            $SubtotalFormat = "Rp " . number_format($subtotal,0,',','.');
            $PpnFormat = "Rp " . number_format($ppn,0,',','.');
            //Format Tanggal
            $strtotime=strtotime($datetime_transaksi);
            $TanggalFormat=date('d/m/Y H:i:s T', $strtotime);
            //Buka Kontak
            $NamaKontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'nama');
            $NamaCs=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'nama');
            $NamaSupervisi=GetDetailData($Conn,'supervisi','id_supervisi',$id_supervisi,'nama');
            //Buka Rincian 
            $rincian_pengiriman_decode=json_decode($rincian_pengiriman);
            $rincian_transaksi_decode=json_decode($rincian_transaksi);

?>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed show" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <b>Detail Transaksi</b>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <div class="col col-md-4">UUID</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $uuid_transaksi; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Tanggal</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $TanggalFormat; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Customer Service</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $NamaCs; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Supervisi</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $NamaSupervisi; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Subtotal (Rp)</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $SubtotalFormat; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">PPN (Rp)</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $PpnFormat; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Pembayaran</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo "$status_pembayaran"; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Pengiriman</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo "$status_pengiriman"; ?></code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <b>Rincian Pengiriman</b>
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <div class="col col-md-4">Nama</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $rincian_pengiriman_decode->nama; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Kontak</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $rincian_pengiriman_decode->no_kontak; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Alamat</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $rincian_pengiriman_decode->alamat ; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Desa/Kelurahan</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $rincian_pengiriman_decode->desa; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Kecamatan</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $rincian_pengiriman_decode->kecamatan; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Kabupaten/Kota</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $rincian_pengiriman_decode->kabupaten; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Provinsi</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $rincian_pengiriman_decode->provinsi; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Kode POS</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $rincian_pengiriman_decode->kode_pos; ?></code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            <b>Rincian Barang</b>
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <div class="col col-md-4">Produk</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish"><?php echo $rincian_transaksi_decode->nama_produk; ?></code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Harga COD</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish">
                                        <?php 
                                            $HargaCod=$rincian_transaksi_decode->harga_cod;
                                            $HargaCod="Rp " . number_format($HargaCod,0,',','.');
                                            echo $HargaCod; 
                                        ?>
                                    </code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Harga Non COD</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish">
                                        <?php 
                                            $HargaNonCod=$rincian_transaksi_decode->harga_non_cod;
                                            $HargaNonCod="Rp " . number_format($HargaNonCod,0,',','.');
                                            echo $HargaNonCod; 
                                        ?>
                                    </code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Berat Paket</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish">
                                        <?php 
                                            $BeratProduk=$rincian_transaksi_decode->berat;
                                            $BeratProduk="" . number_format($BeratProduk,0,',','.');
                                            echo "$BeratProduk Kg"; 
                                        ?>
                                    </code>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col col-md-4">Quantity</div>
                                <div class="col col-md-8">
                                    <code class="text text-grayish">
                                        <?php 
                                            $QtyProduk=$rincian_transaksi_decode->qty;
                                            $QtyProduk="" . number_format($QtyProduk,0,',','.');
                                            echo "$QtyProduk PCS"; 
                                        ?>
                                    </code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php 
        }
    }
?>