<?php
    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi File
    if(empty($_FILES['file_excel']['name'])){
        echo '<tr><td align="center" colspan="7"><code class="text-danger">File tidak boleh kosong</code></td></tr>';
    }else{
        $nama_file=$_FILES['file_excel']['name'];
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['file_excel']['name']) && in_array($_FILES['file_excel']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['file_excel']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $JumlahBaris=count($sheetData);
            $JumlahLooping=$JumlahBaris-1;
            if(empty($JumlahLooping)){
                echo '<tr><td align="center" colspan="7"><code class="text-danger">Tidak ada data pada file excel yang anda upload</code></td></tr>';
            }else{
                echo '<tr>';
                $JumlahKodeValid=0;
                $number=1;
                for($i=1; $i<=$JumlahLooping; $i++){
                    if(empty($sheetData[$i]['0'])){
                        $nama="";
                    }else{
                        $nama=$sheetData[$i]['0'];
                    }
                    if(empty($sheetData[$i]['1'])){
                        $kontak="";
                    }else{
                        $kontak=$sheetData[$i]['1'];
                    }
                    $datetime=date('Y-m-d H:i:s');
                    //Bersihkkan Variabel
                    $nama=validateAndSanitizeInput($nama);
                    $kontak=validateAndSanitizeInput($kontak);
                    //Validasi Jumlah Karakter
                    if(strlen($kontak)>20){
                        $ValidatorProses="Kontak Tidak Boleh Lebih Dari 20 Karakter";
                    }else{
                        //Cek Validasi Duplikat
                        $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE kontak='$kontak'"));
                        if(!empty($ValidasiKontakDuplikat)){
                            $ValidatorProses="Kontak Sudah Terdaftar";
                        }else{
                            if(!preg_match("/^[^a-zA-Z ]*$/", $kontak)){
                                $ValidatorProses="Kontak Hanya boleh angka";
                            }else{
                                $Entry="INSERT INTO kontak (
                                    id_anggota,
                                    id_mitra,
                                    datetime_import,
                                    nama,
                                    email,
                                    kontak,
                                    sumber,
                                    sudah_dihubungi
                                ) VALUES (
                                    '0',
                                    Null,
                                    '$datetime',
                                    '$nama',
                                    '',
                                    '$kontak',
                                    '',
                                    '0'
                                )";
                                $Input=mysqli_query($Conn, $Entry);
                                if($Input){
                                    $ValidatorProses="Berhasil";
                                }else{
                                    $ValidatorProses="Input Gagal";
                                }
                            }
                        }
                    }
                    //Menampilkan Tabel
                    if($ValidatorProses=="Berhasil"){
                        $JumlahKodeValid=$JumlahKodeValid+1;
                        $LabelProses='<code class="text-success">Berhasil</code>';
                    }else{
                        $JumlahKodeValid=$JumlahKodeValid+0;
                        $LabelProses='<code class="text-danger">'.$ValidatorProses.'</code>';
                    }
                    echo '<tr>';
                    echo '  <td align="center"><small class="credit"><code class="text-dark">'.$number.'</code></small></td>';
                    echo '  <td align="left"><small class="credit"><code class="text-dark">'.$nama.'</code></small></td>';
                    echo '  <td align="left"><small class="credit"><code class="text-dark">'.$kontak.'</code></small></td>';
                    echo '  <td align="left"><small class="credit"><code class="text-dark">'.$datetime.'</code></small></td>';
                    echo '  <td align="center"><small class="credit">'.$LabelProses.'</small></td>';
                    echo '</tr>';
                    $number++;
                }
                echo '</tr>';
            }
        }
    }
?>