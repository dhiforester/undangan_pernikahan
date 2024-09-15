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
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR alamat like '%$keyword%' OR kategori like '%$keyword%'"));
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
        // Ketika checkbox dengan id "check_all" diubah
        $('#check_all').change(function(){
            // Jika checkbox "check_all" dicentang
            if($(this).is(':checked')){
                // Ceklis semua checkbox dengan class "check_id_kontak"
                $('.check_id_kontak').prop('checked', true);
            } else {
                // Jika tidak dicentang, hilangkan centang dari semua checkbox dengan class "check_id_kontak"
                $('.check_id_kontak').prop('checked', false);
            }
        });
        
        // Ketika ada perubahan pada checkbox dengan class "check_id_kontak"
        $('.check_id_kontak').change(function(){
            // Jika jumlah checkbox yang dicentang tidak sama dengan jumlah total checkbox, hilangkan centang dari "check_all"
            if($('.check_id_kontak:checked').length != $('.check_id_kontak').length){
                $('#check_all').prop('checked', false);
            } else {
                // Jika semua checkbox dicentang, centang "check_all"
                $('#check_all').prop('checked', true);
            }
        });
    </script>
    <form action="javascript:void(0);" id="ProsesTabelKontak">
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
                            <td align="left"><b>Kontak</b></td>
                            <td align="left"><b>Email</b></td>
                            <td align="left"><b>Alamat</b></td>
                            <td align="left"><b>Kategori</b></td>
                            <td align="center"><b>Dihubungi</b></td>
                            <td align="center"><b>Opsi</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td colspan="8" class="text-center">';
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
                                        $query = mysqli_query($Conn, "SELECT*FROM kontak WHERE nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR alamat like '%$keyword%' OR kategori like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
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
                                    $id_akses= $data['id_akses'];
                                    $uid_kontak= $data['uid_kontak'];
                                    $nama= $data['nama'];
                                    $email= $data['email'];
                                    $kontak= $data['kontak'];
                                    $alamat= $data['alamat'];
                                    $kategori= $data['kategori'];
                                    $sudah_dihubungi= $data['sudah_dihubungi'];
                                    if($sudah_dihubungi=="Sudah"){
                                        $LabelSudahDihubungi='<span class="badge bg-success">Sudah</span>';
                                    }else{
                                        $LabelSudahDihubungi='<span class="badge bg-dark">Belum</span>';
                                    }
                                    //Buka kontak
                                    if(empty($data['kontak'])){
                                        $LabelKontak='<code class="text-grayish">None</code>';
                                    }else{
                                        $kontak=$data['kontak'];
                                        $LabelKontak='<code class="text-dark">'.$kontak.'</code>';
                                    }
                                    //Buka email
                                    if(empty($data['email'])){
                                        $LabelEmail='<code class="text-grayish">None</code>';
                                    }else{
                                        $Email=$data['email'];
                                        $LabelEmail='<code class="text-dark">'.$Email.'</code>';
                                    }
                                    //Buka alamat
                                    if(empty($data['alamat'])){
                                        $LabelAlamat='<small class="credit text-grayish">None</small>';
                                    }else{
                                        $alamat=$data['alamat'];
                                        $LabelAlamat='<small class="credit text-dark">'.$alamat.'</small>';
                                    }
                                    //Buka kategori
                                    if(empty($data['kategori'])){
                                        $LabelKategori='<small class="credit text-grayish">None</small>';
                                    }else{
                                        $kategori=$data['kategori'];
                                        $LabelKategori='<small class="credit text-dark">'.$kategori.'</small>';
                                    }
                                    $Pesan="$PesanTemplate URL:https://www.google.com";
                                    $encodedMessage = urlencode($Pesan);
                                    $whatsappUrl = "https://wa.me/{$kontak}?text={$encodedMessage}";
                        ?>
                                    <tr>
                                        <td align="center">
                                            <input type="checkbox" class="form-check-input check_id_kontak" name="check_id_kontak[]" value="<?php echo $id_kontak; ?>">
                                        </td>
                                        <td align="left">
                                            <a href="javascript:void(0);" class="text text-info" data-bs-toggle="modal" data-bs-target="#ModalDetail" data-id="<?php echo "$id_kontak"; ?>">
                                                <small class="credit">
                                                    <?php echo $nama; ?>
                                                </small>
                                            </a>
                                        </td>
                                        <td align="left">
                                            <small class="credit">
                                                <?php echo $LabelKontak; ?>
                                            </small>
                                        </td>
                                        <td align="left">
                                            <small class="credit">
                                                <?php echo $LabelEmail; ?>
                                            </small>
                                        </td>
                                        <td align="left">
                                            <small class="credit">
                                                <?php echo $LabelAlamat; ?>
                                            </small>
                                        </td>
                                        <td align="left">
                                            <small class="credit">
                                                <?php echo $LabelKategori; ?>
                                            </small>
                                        </td>
                                        <td align="center">
                                            <small class="credit">
                                                <?php echo $LabelSudahDihubungi; ?>
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
                                                <?php if($sudah_dihubungi=="Belum"){ ?>
                                                    <a href="<?php echo "$whatsappUrl"; ?>" target="_blank" class="dropdown-item" data-id="<?php echo "$id_kontak"; ?>">
                                                        <i class="bi bi-whatsapp"></i> Kirim WA
                                                    </a>
                                                <?php } ?>
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
                        <tr>
                            <td colspan="8">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i> Option
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                    <li class="dropdown-header text-start">
                                        <h6>Option</h6>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalEdit" data-id="<?php echo "$id_kontak"; ?>">
                                            <i class="bi bi-send"></i> Kirim Undangan Via Email
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalSudahDihubungi" data-id="<?php echo "$id_kontak"; ?>">
                                            <i class="bi bi-phone-vibrate"></i> Tandai Sudah Dihubungi
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalUbahKategoriMulti">
                                            <i class="bi bi-tag"></i> Ubah Kategori
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalHapusMulti">
                                            <i class="bi bi-x"></i> Hapus Kontak
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