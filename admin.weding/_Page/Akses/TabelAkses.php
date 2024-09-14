<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    if(empty($SessionIdAkses)){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '  Sessi Akses Sudah Berakhir, Silahkan Login Ulang!';
        echo '</div>';
    }else{
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
            if($ShortBy=="ASC"){
                $NextShort="DESC";
            }else{
                $NextShort="ASC";
            }
        }else{
            $ShortBy="DESC";
            $NextShort="ASC";
        }
        //OrderBy
        if(!empty($_POST['OrderBy'])){
            $OrderBy=$_POST['OrderBy'];
        }else{
            $OrderBy="id_akses";
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
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE nama like '%$keyword%' OR email like '%$keyword%' OR datetime_update like '%$keyword%'"));
            }
        }else{
            if(empty($keyword)){
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE $keyword_by like '%$keyword%'"));
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
                url     : "_Page/Akses/TabelAkses.php",
                method  : "POST",
                data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelAkses').html(data);
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
                url     : "_Page/Akses/TabelAkses.php",
                method  : "POST",
                data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success : function (data) {
                    $('#MenampilkanTabelAkses').html(data);
                    $('#page').val(page);
                }
            })
        });
    </script>
    <div class="row">
        <div class="col-md-4">
            <small class="credit">
                Jumlah Halaman : <code class="text-grayish"><?php echo "$page/$JmlHalaman"; ?></code>
            </small><br>
            <small class="credit">
                Jumlah Data : <code class="text-grayish"><?php echo "$jml_data"; ?></code>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="table table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td align="center"><b>No</b></td>
                        <td align="center"><b>Nama</b></td>
                        <td align="center"><b>Email</b></td>
                        <td align="center"><b>Datetime Update</b></td>
                        <td align="center"><b>Option</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(empty($jml_data)){
                            echo '<tr>';
                            echo '  <td colspan="5" class="text-center">';
                            echo '      <code class="text-danger">';
                            echo '          Tidak Ada Data Entitias Yang Dapat Ditampilkan';
                            echo '      </code>';
                            echo '  </td>';
                            echo '</tr>';
                        }else{
                            $no = 1+$posisi;
                            //KONDISI PENGATURAN MASING FILTER
                            if(empty($keyword_by)){
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT*FROM akses ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT*FROM akses WHERE nama like '%$keyword%' OR email like '%$keyword%' OR datetime_update like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                            }else{
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT*FROM akses ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT*FROM akses WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                            }
                            while ($data = mysqli_fetch_array($query)) {
                                $id_akses= $data['id_akses'];
                                $nama= $data['nama'];
                                $email= $data['email'];
                                $datetime_update= $data['datetime_update'];
                                //Format Tanggal
                                $strtotime2=strtotime($datetime_update);
                                //Menampilkan Tanggal
                                $DateUpdate=date('d/m/Y H:i:s T', $strtotime2);
                    ?>
                                <tr>
                                    <td align="center"><?php echo $no; ?></td>
                                    <td align="left">
                                        <small class="credit">
                                            <?php
                                                echo '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailAkses" data-id="'.$id_akses.'" class="text text-decoration-underline">';
                                                echo '  '.$nama.'';
                                                echo '</a>';
                                            ?>
                                        </small>
                                    </td>
                                    <td align="left">
                                        <small class="credit">
                                            <?php
                                                echo "$email";
                                            ?>
                                        </small>
                                    </td>
                                    <td align="left">
                                        <small class="credit">
                                            <?php
                                                echo "$DateUpdate";
                                            ?>
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
                                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalDetailAkses" data-id="<?php echo "$id_akses"; ?>">
                                                    <i class="bi bi-info-circle"></i> Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalEditAkses" data-id="<?php echo "$id_akses"; ?>">
                                                    <i class="bi bi-pencil"></i> Ubah Info
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalUbahFotoAkses" data-id="<?php echo "$id_akses"; ?>">
                                                    <i class="bi bi-image"></i> Ubah Foto
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword" data-id="<?php echo "$id_akses"; ?>">
                                                    <i class="bi bi-lock"></i> Ubah Password
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalLogAkses" data-id="<?php echo "$id_akses"; ?>">
                                                    <i class="bi bi-list-check"></i> Log Aktivitas
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalHapusAkses" data-id="<?php echo "$id_akses"; ?>">
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
<?php } ?>