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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE id_akses like '%$keyword%' OR nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR sumber like '%$keyword%'  OR sudah_dihubungi like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE $keyword_by like '%$keyword%'"));
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
            url     : "_Page/Kontak/TabelKontak.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelKontak').html(data);
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
            url     : "_Page/Kontak/TabelKontak.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelKontak').html(data);
                $('#page').val(page);
            }
        })
    });
</script>
<div class="row mb-3">
    <div class="table table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <td align="center"><b>No</b></td>
                    <td align="left"><b>Nama</b></td>
                    <td align="left"><b>Kontak</b></td>
                    <td align="left"><b>Mitra</b></td>
                    <td align="center"><b>Dihubungi</b></td>
                    <td align="center"><b>CS</b></td>
                    <td align="center"><b>Opsi</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(empty($jml_data)){
                        echo '<tr>';
                        echo '  <td colspan="7" class="text-center">';
                        echo '      <code class="text-danger">';
                        echo '          Tidak Ada Data Kontak Yang Dapat Ditampilkan';
                        echo '      </code>';
                        echo '  </td>';
                        echo '</tr>';
                    }else{
                        $no = 1+$posisi;
                        //KONDISI PENGATURAN MASING FILTER
                        if(empty($keyword_by)){
                            if(empty($keyword)){
                                $query = mysqli_query($Conn, "SELECT*FROM kontak ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                            }else{
                                $query = mysqli_query($Conn, "SELECT*FROM kontak WHERE id_akses like '%$keyword%' OR nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR sumber like '%$keyword%'  OR sudah_dihubungi like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                            }
                        }else{
                            if(empty($keyword)){
                                $query = mysqli_query($Conn, "SELECT*FROM kontak ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                            }else{
                                $query = mysqli_query($Conn, "SELECT*FROM kontak WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
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
                                $LabelSumber='<small class="credit text-grayish">None</small>';
                            }else{
                                $sumber=$data['sumber'];
                                $LabelSumber='<small class="credit text-dark">'.$sumber.'</small>';
                            }
                ?>
                            <tr>
                                <td align="center">
                                    <small class="credit">
                                        <?php echo $no; ?>
                                    </small>
                                </td>
                                <td align="left">
                                    <small class="credit">
                                        <?php echo $nama; ?>
                                    </small>
                                </td>
                                <td align="left">
                                    <small class="credit">
                                        <?php echo $kontak; ?>
                                    </small>
                                </td>
                                <td align="left">
                                    <?php echo $LabelSumber; ?>
                                </td>
                                <td align="center">
                                    <small class="credit">
                                        <?php echo $LabelSudahDihubungi; ?>
                                    </small>
                                </td>
                                <td align="center">
                                    <small class="credit">
                                        <code class="text text-dark"><?php echo $NamaAnggota; ?></code>
                                    </small>
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
                                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalDetail" data-id="<?php echo "$id_kontak"; ?>">
                                                <i class="bi bi-info-circle"></i> Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalEdit" data-id="<?php echo "$id_kontak"; ?>">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalHapus" data-id="<?php echo "$id_kontak"; ?>">
                                                <i class="bi bi-x"></i> Hapus
                                            </a>
                                        </li>
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