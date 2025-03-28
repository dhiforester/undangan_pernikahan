<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/SettingGeneral.php";
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
        }else{
            $ShortBy="DESC";
        }
        //OrderBy
        if(!empty($_POST['OrderBy'])){
            $OrderBy=$_POST['OrderBy'];
        }else{
            $OrderBy="id";
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
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM testimoni"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM testimoni WHERE nama like '%$keyword%' OR pesan like '%$keyword%' OR datetime like '%$keyword%' OR status like '%$keyword%'"));
            }
        }else{
            if(empty($keyword)){
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM testimoni"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM testimoni WHERE $keyword_by like '%$keyword%'"));
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
                url     : "_Page/Komentar/TabelKomentar.php",
                method  : "POST",
                data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelKomentar').html(data);
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
                url     : "_Page/Komentar/TabelKomentar.php",
                method  : "POST",
                data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success : function (data) {
                    $('#MenampilkanTabelKomentar').html(data);
                    $('#page').val(page);
                }
            })
        });
        // Ketika checkbox dengan id "check_all" diubah
        $('#check_all').change(function(){
            // Jika checkbox "check_all" dicentang
            if($(this).is(':checked')){
                // Ceklis semua checkbox dengan class "check_id_Komentar"
                $('.check_id_Komentar').prop('checked', true);
            } else {
                // Jika tidak dicentang, hilangkan centang dari semua checkbox dengan class "check_id_Komentar"
                $('.check_id_Komentar').prop('checked', false);
            }
        });
        
        // Ketika ada perubahan pada checkbox dengan class "check_id_Komentar"
        $('.check_id_Komentar').change(function(){
            // Jika jumlah checkbox yang dicentang tidak sama dengan jumlah total checkbox, hilangkan centang dari "check_all"
            if($('.check_id_Komentar:checked').length != $('.check_id_Komentar').length){
                $('#check_all').prop('checked', false);
            } else {
                // Jika semua checkbox dicentang, centang "check_all"
                $('#check_all').prop('checked', true);
            }
        });
    </script>
    <form action="javascript:void(0);" id="ProsesTabelKomentar">
        <div class="row mb-3">
            <div class="table table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <td align="center">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="check_all" id="check_all" value="yes">
                                </div>
                            </td>
                            <td align="left"><b>Nama</b></td>
                            <td align="left"><b>Komentar</b></td>
                            <td align="left"><b>Datetime</b></td>
                            <td align="left"><b>Status</b></td>
                            <td align="center"><b>Opsi</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td colspan="8" class="text-center">';
                                echo '      <code class="text-danger">';
                                echo '          Tidak Ada Data Komentar Yang Dapat Ditampilkan';
                                echo '      </code>';
                                echo '  </td>';
                                echo '</tr>';
                            }else{
                                $no = 1+$posisi;
                                //KONDISI PENGATURAN MASING FILTER
                                if(empty($keyword_by)){
                                    if(empty($keyword)){
                                        $query = mysqli_query($Conn, "SELECT*FROM testimoni ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }else{
                                        $query = mysqli_query($Conn, "SELECT*FROM testimoni WHERE nama like '%$keyword%' OR pesan like '%$keyword%' OR datetime like '%$keyword%' OR status like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }
                                }else{
                                    if(empty($keyword)){
                                        $query = mysqli_query($Conn, "SELECT*FROM testimoni ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }else{
                                        $query = mysqli_query($Conn, "SELECT*FROM testimoni WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }
                                }
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_komentar= $data['id'];
                                    $nama= $data['nama'];
                                    $pesan= $data['pesan'];
                                    $datetime= $data['datetime'];
                                    $status= $data['status'];
                                    if($status=="Draft"){
                                        $LabelStatus='<span class="badge bg-danger">Draft</span>';
                                    }else{
                                        $LabelStatus='<span class="badge bg-success">Publish</span>';
                                    }
                                    $strtotime=strtotime($datetime);
                                    $DatetimeFormat=date('d/m/Y H:i', $strtotime);
                        ?>
                                    <tr>
                                        <td align="center">
                                            <input type="checkbox" class="form-check-input check_id_Komentar" name="check_id_Komentar[]" value="<?php echo $id_komentar; ?>">
                                        </td>
                                        <td align="left">
                                            <a href="javascript:void(0);" class="text text-info" data-bs-toggle="modal" data-bs-target="#ModalDetail" data-id="<?php echo "$id_komentar"; ?>">
                                                <small class="credit">
                                                    <?php echo $nama; ?>
                                                </small>
                                            </a>
                                        </td>
                                        <td align="left">
                                            <small class="credit">
                                                <?php echo $pesan; ?>
                                            </small>
                                        </td>
                                        <td align="left">
                                            <small class="credit">
                                                <?php echo $DatetimeFormat; ?>
                                            </small>
                                        </td>
                                        <td align="center">
                                            <?php echo $LabelStatus; ?>
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
                                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalDetail" data-id="<?php echo "$id_komentar"; ?>">
                                                        <i class="bi bi-info-circle"></i> Detail
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalEdit" data-id="<?php echo "$id_komentar"; ?>">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalHapus" data-id="<?php echo "$id_komentar"; ?>">
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
                        <tr>
                            <td colspan="8">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i> Option
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                    <li class="dropdown-header text-start">
                                        <h6>Option</h6>
                                    </li>
                                    <!-- <li>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalSudahDihubungi">
                                            <i class="bi bi-phone-vibrate"></i> Update Publish
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalUbahKategoriMulti">
                                            <i class="bi bi-tag"></i> Update Draft
                                        </a>
                                    </li> -->
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalHapusMulti">
                                            <i class="bi bi-x"></i> Hapus Komentar
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mb-3">
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
    </form>
<?php } ?>