<?php
    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    if (empty($SessionIdAkses)) {
        echo '<tr><td align="center" colspan="8"><code class="text-danger">Sesi Akses Sudah Berakhir, Silahkan Login Ulang</code></td></tr>';
        exit;
    }
    if (empty($_FILES['file_excel']['name'])) {
        echo '<tr><td align="center" colspan="8"><code class="text-danger">File tidak boleh kosong</code></td></tr>';
        exit;
    }
    $nama_file = $_FILES['file_excel']['name'];
    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if (isset($_FILES['file_excel']['name']) && in_array($_FILES['file_excel']['type'], $file_mimes)) {
        $arr_file = explode('.', $_FILES['file_excel']['name']);
        $extension = end($arr_file);
        $reader = ('csv' == $extension) ? new \PhpOffice\PhpSpreadsheet\Reader\Csv() : new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $JumlahBaris = count($sheetData);
        $JumlahLooping = $JumlahBaris - 1;
        
        if (empty($JumlahLooping)) {
            echo '<tr><td align="center" colspan="8"><code class="text-danger">Tidak ada data pada file excel yang anda upload</code></td></tr>';
        } else {
            // Mendapatkan baris saat ini dan batas 100 baris
            $currentRow = isset($_POST['currentRow']) ? (int)$_POST['currentRow'] : 1;
            $totalProcessed = isset($_POST['totalProcessed']) ? (int)$_POST['totalProcessed'] : 0;
            $endRow = $currentRow + 99;
            $JumlahKodeValid = 0;
            echo '<tr>';
            $number = $totalProcessed + 1; // Mulai nomor dari total data yang sudah diproses
            for ($i = $currentRow; $i <= $JumlahLooping && $i <= $endRow; $i++) {
                $nama = validateAndSanitizeInput($sheetData[$i][0] ?? '');
                $email = validateAndSanitizeInput($sheetData[$i][1] ?? '');
                $kontak = validateAndSanitizeInput($sheetData[$i][2] ?? '');
                $alamat = validateAndSanitizeInput($sheetData[$i][3] ?? '');
                $kategori = validateAndSanitizeInput($sheetData[$i][4] ?? '');
                $sudah_dihubungi = validateAndSanitizeInput($sheetData[$i][5] ?? '');
                $datetime=date('Y-m-d H:i:s');
                //Validasi Jumlah Karakter
                if(strlen($kontak)>20){
                    $ValidatorProses="Kontak Tidak Boleh Lebih Dari 20 Karakter";
                }else{
                    if(strlen($kategori)>50){
                        $ValidatorProses="Kategori Tidak Boleh Lebih Dari 50 Karakter";
                    }else{
                        if(!preg_match("/^[^a-zA-Z ]*$/", $kontak)){
                            $ValidatorProses="Kontak Hanya boleh angka";
                        }else{
                            if(strlen($sudah_dihubungi)>5){
                                $ValidatorProses="Informasi Sudah Dihubungi Tidak Boleh Lebih Dari 5 Karakter";
                            }else{
                                $uid_kontak=GenerateToken(36);
                                $Entry="INSERT INTO kontak (
                                    id_akses,
                                    uid_kontak,
                                    nama,
                                    email,
                                    kontak,
                                    alamat,
                                    kategori,
                                    sudah_dihubungi
                                ) VALUES (
                                    '$SessionIdAkses',
                                    '$uid_kontak',
                                    '$nama',
                                    '$email',
                                    '$kontak',
                                    '$alamat',
                                    '$kategori',
                                    '$sudah_dihubungi'
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
                }
                // Menampilkan Tabel
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
                echo '  <td align="left"><small class="credit"><code class="text-dark">'.$email.'</code></small></td>';
                echo '  <td align="left"><small class="credit"><code class="text-dark">'.$alamat.'</code></small></td>';
                echo '  <td align="left"><small class="credit"><code class="text-dark">'.$kategori.'</code></small></td>';
                echo '  <td align="left"><small class="credit"><code class="text-dark">'.$sudah_dihubungi.'</code></small></td>';
                echo '  <td align="center"><small class="credit">'.$LabelProses.'</small></td>';
                echo '</tr>';
                $number++;
            }
            echo '</tr>';
            // Periksa jika masih ada data untuk diimpor
            if ($i <= $JumlahLooping) {
                echo 'Lanjutkan'; // Tanda bahwa ada data yang masih perlu diimpor
            } else {
                echo 'Selesai'; // Tanda bahwa impor telah selesai
            }
        }
    }
?>