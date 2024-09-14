<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($SessionIdAkses)){
        echo '<small class="text-danger">Sesi Akses Sudah Berakhir, Silahkan Login Ulang</small>';
    }else{
        //Validasi nama tidak boleh kosong
        if(empty($_POST['nama'])){
            echo '<code class="text-danger">Nama tidak boleh kosong</code>';
        }else{
            //Validasi kontak tidak boleh kosong
            if(empty($_POST['kontak'])){
                echo '<code class="text-danger">Nomor kontak tidak boleh kosong</code>';
            }else{
                //Buat Variabel
                $nama=$_POST['nama'];
                $kontak=$_POST['kontak'];
                if(empty($_POST['email'])){
                    $email="";
                }else{
                    $email=$_POST['email'];
                }
                if(empty($_POST['id_mitra'])){
                    $id_mitra="0";
                    $sumber="";
                }else{
                    $id_mitra=$_POST['id_mitra'];
                    $sumber=GetDetailData($Conn,'mitra','id_mitra',$id_mitra,'nama');
                }
                if(empty($_POST['sudah_dihubungi'])){
                    $sudah_dihubungi="0";
                }else{
                    $sudah_dihubungi=$_POST['sudah_dihubungi'];
                }
                //Bersihkan Variabel
                $nama=validateAndSanitizeInput($nama);
                $kontak=validateAndSanitizeInput($kontak);
                $email=validateAndSanitizeInput($email);
                $sumber=validateAndSanitizeInput($sumber);
                $sudah_dihubungi=validateAndSanitizeInput($sudah_dihubungi);
                //Validasi Duplikat
                $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE kontak='$kontak'"));
                if(!empty($ValidasiKontakDuplikat)){
                    echo '<code class="text-danger">Kontak yang anda masukan sudah ada sebelumnya</code>';
                }else{
                    //Validasi kontak tidak boleh lebih dari 20 karakter
                    if(!preg_match("/^[^a-zA-Z ]*$/", $_POST['kontak'])){
                        echo '<small class="text-danger">Kontak maksimal 20 karakter numerik</small>';
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
                            '$id_mitra',
                            '$now',
                            '$nama',
                            '$email',
                            '$kontak',
                            '$sumber',
                            '$sudah_dihubungi'
                        )";
                        $Input=mysqli_query($Conn, $Entry);
                        if($Input){
                            $KategoriLog="Kontak";
                            $KeteranganLog="Tambah Kontak baru";
                            include "../../_Config/InputLog.php";
                            echo '<small class="text-success" id="NotifikasiTambahBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data anggota</small>';
                        }
                    }
                }
            }
        }
    }
?>