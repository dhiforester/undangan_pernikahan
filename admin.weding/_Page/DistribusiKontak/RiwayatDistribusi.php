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
        $OrderBy="id_anggota";
    }
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT DISTINCT tanggal FROM distribusi_kontak"));
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
            url     : "_Page/DistribusiKontak/RiwayatDistribusi.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanRiwayatDistribusi').html(data);
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
            url     : "_Page/DistribusiKontak/RiwayatDistribusi.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanRiwayatDistribusi').html(data);
            }
        })
    });
</script>
<?php
    if(empty($jml_data)){
        echo '<div class="row mb-3 border-1 border-bottom">';
        echo '  <div class="col-md-12 text-center">';
        echo '      <code class="text-danger">';
        echo '          Tidak Ada Data Riwayat Distribusi Yang Dapat Ditampilkan';
        echo '      </code>';
        echo '  </div>';
        echo '</div>';
    }else{
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        $query = mysqli_query($Conn, "SELECT DISTINCT tanggal FROM distribusi_kontak ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
        while ($data = mysqli_fetch_array($query)) {
            $tanggal= $data['tanggal'];
            $JumlahAnggota = mysqli_num_rows(mysqli_query($Conn, "SELECT id_distribusi_kontak FROM distribusi_kontak WHERE tanggal='$tanggal'"));
            //Format Tanggal
            $strtotime=strtotime($tanggal);
            $TanggalFormat=date('d/m/Y',$strtotime);
            //Jumlah Distribusi
            $Sum = mysqli_fetch_array(mysqli_query($Conn, "SELECT SUM(distribusi) AS jumlah_distribusi FROM distribusi_kontak WHERE tanggal='$tanggal'"));
            $JumlahDistribusiPerTanggal = $Sum['jumlah_distribusi'];
            echo '<div class="row mb-3 border-1 border-bottom">';
            echo '  <div class="col-md-12 mb-3">';
            echo '      <b>';
            echo '          <a href="">'.$TanggalFormat.'</a>';
            echo '      </b><br>';
            echo '      Customer Service: <code>'.$JumlahAnggota.' Orang</code><br>';
            echo '      Kontak: <code>'.$JumlahDistribusiPerTanggal.' Record</code><br>';
            echo '  </div>';
            echo '</div>';
            $no++; 
        }
    }
?>
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