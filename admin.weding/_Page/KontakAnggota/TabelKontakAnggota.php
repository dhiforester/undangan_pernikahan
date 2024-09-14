<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Session.php";
    if(empty($SessionIdAkses)){
        echo '<div class="card">';
        echo '  <div class="card-body text-center">';
        echo '      <code class="text-danger">';
        echo '          Sesi Akses Sudah Berakhir. Silahkan Login Ulang';
        echo '      </code>';
        echo '  </div>';
        echo '</div>';
    }
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
        $OrderBy="id_kontak";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE id_anggota='$SessionIdAkses'"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE (id_anggota='$SessionIdAkses') AND (id_akses like '%$keyword%' OR nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR sumber like '%$keyword%'  OR sudah_dihubungi like '%$keyword%')"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE id_anggota='$SessionIdAkses'"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE (id_anggota='$SessionIdAkses') AND ($keyword_by like '%$keyword%')"));
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
        $('#MenampilkanTabelKontakAnggota').html('Loading...');
        $.ajax({
            url     : "_Page/KontakAnggota/TabelKontakAnggota.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelKontakAnggota').html(data);
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
        $('#MenampilkanTabelKontakAnggota').html('Loading...');
        $.ajax({
            url     : "_Page/KontakAnggota/TabelKontakAnggota.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelKontakAnggota').html(data);
                $('#page').val(page);
            }
        })
    });
    $('.kirim_pesan').click(function() {
        var dataId = $(this).data('id');
        $(this).html('...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/KontakAnggota/ProsesKirimPesan.php',
            data 	    :  {id_kontak: dataId},
            enctype     : 'multipart/form-data',
            success     : function(data){
                $(this).html(data);
                filterAndLoadTable();
            }
        });
    });
</script>
<?php
    if(empty($jml_data)){
        echo '<div class="card">';
        echo '  <div class="card-body text-center">';
        echo '      <code class="text-danger">';
        echo '          Tidak Ada Data Kontak Yang Dapat Ditampilkan';
        echo '      </code>';
        echo '  </div>';
        echo '</div>';
    }else{
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        if(empty($keyword_by)){
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM kontak WHERE id_anggota='$SessionIdAkses' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM kontak WHERE (id_anggota='$SessionIdAkses') AND (nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR sumber like '%$keyword%'  OR sudah_dihubungi like '%$keyword%' )ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }else{
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM kontak WHERE id_anggota='$SessionIdAkses' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM kontak WHERE (id_anggota='$SessionIdAkses') AND ($keyword_by like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }
        while ($data = mysqli_fetch_array($query)) {
            $id_kontak= $data['id_kontak'];
            $id_anggota= $data['id_anggota'];
            $datetime_import= $data['datetime_import'];
            $nama= $data['nama'];
            $kontak= $data['kontak'];
            $sumber= $data['sumber'];
            $sudah_dihubungi= $data['sudah_dihubungi'];
            if($sudah_dihubungi==1){
                $LabelSudahDihubungi='<span class="badge bg-success">Sudah</span>';
            }else{
                $LabelSudahDihubungi='<span class="badge bg-dark">Belum</span>';
            }
            //Buka Nama Anggota
            if(empty($data['id_anggota'])){
                $NamaAnggota='<code class="text-danger">None</code>';
            }else{
                $NamaAnggota=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'nama');
                $NamaAnggota='<code class="text-success">'.$NamaAnggota.'</code>';
            }
            //Buka email
            if(empty($data['email'])){
                $EmailLabel='<code class="text-grayish">None</code>';
            }else{
                $Email=$data['email'];
                $EmailLabel='<code class="text-dark">'.$Email.'</code>';
            }
            //Buka sumber
            if(empty($data['sumber'])){
                $LabelSumber='<code class="text-grayish">None</code>';
            }else{
                $sumber=$data['sumber'];
                $LabelSumber='<code class="text-dark">'.$sumber.'</code>';
            }
            $Pesan=$PesanTemplate;
            $encodedMessage = urlencode($Pesan);
            $whatsappUrl = "https://wa.me/{$kontak}?text={$encodedMessage}";
?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <b><?php echo "$no. $nama";?></b><br>
                            <small class="credit">
                                <code>
                                    <a href="index.php?Page=TransaksiAnggota&id=<?php echo $id_kontak; ?>" class="text-primary">Transaksi/Order</a>
                                </code>
                            </small>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="row">
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-dark">Tlp: </code>
                                        <code class="text text-grayish"><?php echo "$kontak"; ?></code>
                                    </small>
                                </div>
                                <div class="col col-md-6">
                                    <small class="credit">
                                        <code class="text text-dark">Status: </code>
                                        <code class="text text-grayish"><?php echo "$LabelSudahDihubungi"; ?></code>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <?php if($sudah_dihubungi==1){ ?>
                                <a href="javascript:void(0);" class="btn btn-sm btn-grayish btn-rounded">
                                    <i class="bi bi-send"></i> Kirim
                                </a>
                            <?php }else{ ?>
                                <a href="<?php echo "$whatsappUrl"; ?>" target="_blank" class="btn btn-sm btn-success btn-rounded kirim_pesan" data-id="<?php echo "$id_kontak"; ?>">
                                    <i class="bi bi-send"></i> Kirim
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
<?php
            $no++; 
        }
    }
?>
<div class="row mt-5">
    <div class="col-md-12 text-center">
        <div class="btn-group shadow-0" role="group" aria-label="Basic example">
            <button class="btn btn-md btn-info" id="PrevPage" value="<?php echo $prev;?>">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="btn btn-md btn-outline-info">
                <?php echo "$page of $JmlHalaman"; ?>
            </button>
            <button class="btn btn-md btn-info" id="NextPage" value="<?php echo $next;?>">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</div>