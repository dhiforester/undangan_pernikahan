<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($SessionIdAkses)){
        echo '<small class="text-danger">Sesi Akses Sudah Berakhir, Silahkan Login Ulang</small>';
    }else{
        //Validasi nama tidak boleh kosong
        if(empty($_POST['nama'])){
            echo '<small class="text-danger">Nama tidak boleh kosong</small>';
        }else{
            //Validasi kontak tidak boleh kosong
            if(empty($_POST['kontak'])){
                echo '<small class="text-danger">Kontak tidak boleh kosong</small>';
            }else{
                //Validasi kontak tidak boleh lebih dari 20 karakter
                $JumlahKarakterKontak=strlen($_POST['kontak']);
                if($JumlahKarakterKontak>20||$JumlahKarakterKontak<6||!preg_match("/^[0-9]*$/", $_POST['kontak'])){
                    echo '<small class="text-danger">Kontak terdiri dari 6-20 karakter numerik</small>';
                }else{
                    //Validasi email tidak boleh kosong
                    if(empty($_POST['email'])){
                        echo '<small class="text-danger">Email tidak boleh kosong</small>';
                    }else{
                        //Validasi email duplikat
                        $email=$_POST['email'];
                        $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM mitra WHERE email='$email'"));
                        if(!empty($ValidasiEmailDuplikat)){
                            echo '<small class="text-danger">Email sudah digunakan</small>';
                        }else{
                            //Validasi password tidak boleh kosong
                            if(empty($_POST['password'])){
                                echo '<small class="text-danger">Password tidak boleh kosong</small>';
                            }else{
                                //Validasi jumlah dan jenis karakter password
                                $JumlahKarakterPassword=strlen($_POST['password']);
                                if($JumlahKarakterPassword>20||$JumlahKarakterPassword<6||!preg_match("/^[a-zA-Z0-9]*$/", $_POST['password'])){
                                    echo '<small class="text-danger">Password can only have 6-20 numeric characters</small>';
                                }else{
                                    //Variabel Lainnya
                                    $nama=$_POST['nama'];
                                    $kontak=$_POST['kontak'];
                                    $email=$_POST['email'];
                                    $password=$_POST['password'];
                                    //Bersihkan Variabel
                                    $nama=validateAndSanitizeInput($nama);
                                    $kontak=validateAndSanitizeInput($kontak);
                                    $email=validateAndSanitizeInput($email);
                                    $password=validateAndSanitizeInput($password);
                                    //Validasi Duplikat
                                    $ValidasiDuplikatNama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM mitra WHERE nama='$nama'"));
                                    $ValidasiDuplikatEmail=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM mitra WHERE email='$email'"));
                                    $ValidasiDuplikatKontak=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM mitra WHERE kontak='$kontak'"));
                                    if(!empty($ValidasiDuplikatKontak)){
                                        echo '<small class="text-danger">Nomor kontak tersebut sudah terdaftar</small>';
                                    }else{
                                        if(!empty($ValidasiDuplikatEmail)){
                                            echo '<small class="text-danger">Email tersebut sudah terdaftar</small>';
                                        }else{
                                            if(!empty($ValidasiDuplikatNama)){
                                                echo '<small class="text-danger">Nama mitra tersebut sudah terdaftar</small>';
                                            }else{
                                                //Validasi Gambar
                                                if(!empty($_FILES['foto']['name'])){
                                                    //nama gambar
                                                    $nama_gambar=$_FILES['foto']['name'];
                                                    //ukuran gambar
                                                    $ukuran_gambar = $_FILES['foto']['size']; 
                                                    //tipe
                                                    $tipe_gambar = $_FILES['foto']['type']; 
                                                    //sumber gambar
                                                    $tmp_gambar = $_FILES['foto']['tmp_name'];
                                                    $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                                    $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                                    $FileNameRand=$key;
                                                    $Pecah = explode("." , $nama_gambar);
                                                    $BiasanyaNama=$Pecah[0];
                                                    $Ext=$Pecah[1];
                                                    $namabaru = "$FileNameRand.$Ext";
                                                    $path = "../../assets/img/Mitra/".$namabaru;
                                                    if($tipe_gambar == "image/jpeg"||$tipe_gambar == "image/jpg"||$tipe_gambar == "image/gif"||$tipe_gambar == "image/png"){
                                                        if($ukuran_gambar<2000000){
                                                            if(move_uploaded_file($tmp_gambar, $path)){
                                                                $ValidasiGambar="Valid";
                                                            }else{
                                                                $ValidasiGambar="Upload file foto gagal";
                                                            }
                                                        }else{
                                                            $ValidasiGambar="File foto tidak boleh lebih dari 2 mb";
                                                        }
                                                    }else{
                                                        $ValidasiGambar="Tipe file hanya boleh JPG, JPEG, PNG and GIF";
                                                    }
                                                }else{
                                                    $ValidasiGambar="Valid";
                                                    $namabaru="";
                                                }
                                                //Apabila validasi upload valid maka simpan di database
                                                if($ValidasiGambar!=="Valid"){
                                                    echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                                                }else{
                                                    $entry="INSERT INTO mitra (
                                                        nama,
                                                        kontak,
                                                        email,
                                                        password,
                                                        foto
                                                    ) VALUES (
                                                        '$nama',
                                                        '$kontak',
                                                        '$email',
                                                        '$password',
                                                        '$namabaru'
                                                    )";
                                                    $Input=mysqli_query($Conn, $entry);
                                                    if($Input){
                                                        $KategoriLog="Mitra";
                                                        $KeteranganLog="Tambah Mitra Baru";
                                                        include "../../_Config/InputLog.php";
                                                        echo '<small class="text-success" id="NotifikasiTambahBerhasil">Success</small>';
                                                    }else{
                                                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data akses</small>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>