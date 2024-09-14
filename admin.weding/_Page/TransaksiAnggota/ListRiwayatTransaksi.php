<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    include "../../_Partial/FungsiAkses.php";
    date_default_timezone_set("Asia/Jakarta");
    //Keyword_by
    //batas
    if(!empty($_POST['batas'])){
        $batas=$_POST['batas'];
    }else{
        $batas="10";
    }
    //ShortBy
    if(!empty($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
    }else{
        $ShortBy="DESC";
    }
    //OrderBy
    if(!empty($_POST['OrderBy'])){
        $OrderBy=$_POST['OrderBy'];
    }else{
        $OrderBy="id_transaksi";
    }
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM transaksi WHERE id_anggota='$SessionIdAkses'"));
    //Mengatur Halaman
    $JmlHalaman = ceil($jml_data/$batas); 
    $prev=$page-1;
    $next=$page+1;
    if($next>$JmlHalaman){
        $next=$page;
    }else{
        $next=$page+1;
    }
    if($prev<"1"){
        $prev="1";
    }else{
        $prev=$page-1;
    }
?>
<script>
    //ketika klik next
    $('#NextPage').click(function() {
        var page=$('#NextPage').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/Transaksi/TabelTransaksi.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelTransaksi').html(data);
                $('#page').val(page);
            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage').click(function() {
        var page = $('#PrevPage').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/Transaksi/TabelTransaksi.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelTransaksi').html(data);
                $('#page').val(page);
            }
        })
    });
</script>
<div class="row mb-3">
    <div class="col-md-12">
        <div class="accordion" id="accordionExample">
            <?php
                if(empty($jml_data)){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12 text-center">';
                    echo '      <code class="text-danger">';
                    echo '          Tidak Ada Data Transaksi Yang Dapat Ditampilkan';
                    echo '      </code>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $no = 1+$posisi;
                    //KONDISI PENGATURAN MASING FILTER
                    $query = mysqli_query($Conn, "SELECT*FROM transaksi WHERE id_anggota='$SessionIdAkses' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_transaksi= $data['id_transaksi'];
                        $uuid_transaksi= $data['uuid_transaksi'];
                        $id_kontak= $data['id_kontak'];
                        $datetime_transaksi= $data['datetime_transaksi'];
                        $status_pembayaran= $data['status_pembayaran'];
                        $status_pengiriman= $data['status_pengiriman'];
                        // $PembayaranFormat = "" . number_format($pembayaran,0,',','.');
                        // $JumlahFormat = "Rp " . number_format($jumlah,0,',','.');
                        //Format Tanggal
                        $strtotime=strtotime($datetime_transaksi);
                        $TanggalFormat=date('d/m/Y H:i:s T', $strtotime);
                        //Bukka Kontak
                        $email=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'email');
                        $nama=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'nama');
                        $kontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'kontak');
            ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?php echo $no; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $no; ?>" aria-expanded="false" aria-controls="collapse<?php echo $no; ?>">
                                    <?php echo $TanggalFormat; ?>
                                </button>
                            </h2>
                            <div id="collapse<?php echo $no; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $no; ?>" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <div class="col md-4">Nama</div>
                                        <div class="col md-8">
                                            <small class="credit"><?php echo $nama; ?></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col md-4">Kontak</div>
                                        <div class="col md-8">
                                            <small class="credit"><?php echo $kontak; ?></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col md-4">Status</div>
                                        <div class="col md-8">
                                            <small class="credit"><?php echo $status_pengiriman; ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                        $no++; 
                    }
                }
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <div class="btn-group shadow-0" role="group" aria-label="Basic example">
            <button class="btn btn-sm btn-info" id="PrevPage" value="<?php echo $prev;?>">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="btn btn-sm btn-outline-info">
                <?php echo "$page of $JmlHalaman"; ?>
            </button>
            <button class="btn btn-sm btn-info" id="NextPage" value="<?php echo $next;?>">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</div>