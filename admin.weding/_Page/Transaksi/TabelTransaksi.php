<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    date_default_timezone_set("Asia/Jakarta");
    //Keyword_by
    if(!empty($_POST['keyword_by'])){
        $keyword_by=$_POST['keyword_by'];
    }else{
        $keyword_by="";
    }
    //keyword
    if(!empty($_POST['keyword'])){
        $keyword=$_POST['keyword'];
    }else{
        $keyword="";
    }
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
    if(empty($keyword_by)){
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM transaksi"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM transaksi WHERE id_supervisi like '%$keyword%' OR id_anggota like '%$keyword%' OR datetime_transaksi like '%$keyword%' OR status_pembayaran like '%$keyword%' OR status_pengiriman like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM transaksi"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM transaksi WHERE $keyword_by like '%$keyword%'"));
        }
    }
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
    <div class="table table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td align="center"><b>No</b></td>
                    <td align="center"><b>Tanggal & Jam</b></td>
                    <td align="center"><b>Supervisi</b></td>
                    <td align="center"><b>Customer Service</b></td>
                    <td align="center"><b>Pelanggan</b></td>
                    <td align="center"><b>Pembayaran</b></td>
                    <td align="center"><b>Pengiriman</b></td>
                    <td align="center"><b>Opsi</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(empty($jml_data)){
                        echo '<tr>';
                        echo '  <td colspan="8" class="text-center">';
                        echo '      <code class="text-danger">';
                        echo '          Tidak Ada Data Transaksi Yang Dapat Ditampilkan';
                        echo '      </code>';
                        echo '  </td>';
                        echo '</tr>';
                    }else{
                        $no = 1+$posisi;
                        //KONDISI PENGATURAN MASING FILTER
                        if(empty($keyword_by)){
                            if(empty($keyword)){
                                $query = mysqli_query($Conn, "SELECT*FROM transaksi ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                            }else{
                                $query = mysqli_query($Conn, "SELECT*FROM transaksi WHERE id_supervisi like '%$keyword%' OR id_anggota like '%$keyword%' OR datetime_transaksi like '%$keyword%' OR status_pembayaran like '%$keyword%' OR status_pengiriman like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                            }
                        }else{
                            if(empty($keyword)){
                                $query = mysqli_query($Conn, "SELECT*FROM transaksi ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                            }else{
                                $query = mysqli_query($Conn, "SELECT*FROM transaksi WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                            }
                        }
                        while ($data = mysqli_fetch_array($query)) {
                            $id_transaksi= $data['id_transaksi'];
                            $uuid_transaksi= $data['uuid_transaksi'];
                            $id_supervisi= $data['id_supervisi'];
                            $id_anggota= $data['id_anggota'];
                            $id_kontak= $data['id_kontak'];
                            $datetime_transaksi= $data['datetime_transaksi'];
                            $jumlah= $data['jumlah'];
                            $status_pembayaran= $data['status_pembayaran'];
                            $status_pengiriman= $data['status_pengiriman'];
                            $jumlah = "" . number_format($jumlah,0,',','.');
                            //Format Tanggal
                            $strtotime=strtotime($datetime_transaksi);
                            $TanggalFormat=date('d/m/Y H:i:s T', $strtotime);
                            //Buka Nama Supervisi
                            $NamaSupervisi=GetDetailData($Conn,'supervisi','id_supervisi',$id_supervisi,'nama');
                            $NamaCs=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'nama');
                            $NamaKontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'nama');
                ?>
                            <tr>
                                <td align="center"><?php echo $no; ?></td>
                                <td align="left">
                                    <small class="credit">
                                        <code class="text-dark"><?php echo $TanggalFormat; ?></code>
                                    </small>
                                </td>
                                <td align="left">
                                    <small class="credit">
                                        <code class="text-dark"><?php echo $NamaSupervisi; ?></code>
                                    </small>
                                </td>
                                <td align="left">
                                    <small class="credit">
                                        <code class="text-dark"><?php echo $NamaCs; ?></code>
                                    </small>
                                </td>
                                <td align="right">
                                    <small class="credit">
                                        <code class="text-dark"><?php echo $NamaKontak; ?></code>
                                    </small>
                                </td>
                                <td align="right">
                                    <?php
                                        if($status_pembayaran=="Lunas"){
                                            echo '<badge class="badge bg-success">Lunas</badge>';
                                        }else{
                                            if($status_pembayaran=="Dibatalkan"){
                                                echo '<badge class="badge bg-danger">Dibatalkan</badge>';
                                            }else{
                                                if($status_pembayaran=="Pending"){
                                                    echo '<badge class="badge bg-warning">Pending</badge>';
                                                }else{
                                                    echo '<badge class="badge bg-dark">None</badge>';
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                        if($status_pengiriman=="Proses"){
                                            echo '<badge class="badge bg-info">Proses</badge>';
                                        }else{
                                            if($status_pengiriman=="Dibatalkan"){
                                                echo '<badge class="badge bg-danger">Dibatalkan</badge>';
                                            }else{
                                                if($status_pengiriman=="Pending"){
                                                    echo '<badge class="badge bg-warning">Pending</badge>';
                                                }else{
                                                    if($status_pengiriman=="Selesai"){
                                                        echo '<badge class="badge bg-success">Selesai</badge>';
                                                    }else{
                                                        echo '<badge class="badge bg-dark">None</badge>';
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                                <td align="center">
                                    <a class="btn btn-sm btn-outline-dark btn-rounded" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                        <li class="dropdown-header text-start">
                                            <h6>Option</h6>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalDetail" data-id="<?php echo "$id_transaksi"; ?>">
                                                <i class="bi bi-info-circle"></i> Detail
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a class="dropdown-item" href="index.php?Page=Transaksi&Sub=EditTransaksi&id=<?php echo "$id_transaksi"; ?>">
                                                <i class="bi bi-pencil"></i> Ubah/Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalHapus" data-id="<?php echo "$id_transaksi"; ?>">
                                                <i class="bi bi-x"></i> Hapus
                                            </a>
                                        </li> -->
                                    </ul>
                                </td>
                            </tr>
                <?php
                            $no++; 
                        }
                    }
                ?>
            </tbody>
        </table>
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