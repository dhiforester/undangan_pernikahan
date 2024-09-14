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
        //Validasi id_anggota tidak boleh kosong
        if(empty($_POST['id_anggota'])){
            echo '<code class="text-danger">ID Anggota Tidak Boleh Kosong</code>';
        }else{
            //Validasi nama tidak boleh kosong
            if(empty($_POST['nama'])){
                echo '<code class="text-danger">Nama tidak boleh kosong</code>';
            }else{
                //Validasi id_supervisi tidak boleh kosong
                if(empty($_POST['id_supervisi'])){
                    echo '<code class="text-danger">Supervisi tidak boleh kosong</code>';
                }else{
                    //Validasi kontak tidak boleh kosong
                    if(empty($_POST['kontak'])){
                        echo '<code class="text-danger">Nomor kontak tidak boleh kosong</code>';
                    }else{
                        //Validasi email tidak boleh kosong
                        if(empty($_POST['email'])){
                            echo '<code class="text-danger">Email tidak boleh kosong</code>';
                        }else{
                            //Validasi password tidak boleh kosong
                            if(empty($_POST['password'])){
                                echo '<code class="text-danger">Password tidak boleh kosong</code>';
                            }else{
                                //Validasi status tidak boleh kosong
                                if(empty($_POST['status'])){
                                    echo '<code class="text-danger">Status anggota tidak boleh kosong</code>';
                                }else{
                                    //Buat Variabel
                                    $id_anggota=$_POST['id_anggota'];
                                    $nama=$_POST['nama'];
                                    $id_supervisi=$_POST['id_supervisi'];
                                    $status=$_POST['status'];
                                    $kontak=$_POST['kontak'];
                                    $email=$_POST['email'];
                                    $password=$_POST['password'];
                                    //Bersihkan Variabel
                                    $id_anggota=validateAndSanitizeInput($id_anggota);
                                    $nama=validateAndSanitizeInput($nama);
                                    $id_supervisi=validateAndSanitizeInput($id_supervisi);
                                    $status=validateAndSanitizeInput($status);
                                    $kontak=validateAndSanitizeInput($kontak);
                                    $email=validateAndSanitizeInput($email);
                                    $password=validateAndSanitizeInput($password);
                                    //Buka Data Lama
                                    $EmailLama=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'email');
                                    $KontakLama=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'kontak');
                                    $FotoLama=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'foto');
                                    //Validasi Duplikat
                                    if($KontakLama==$kontak){
                                        $ValidasiKontakDuplikat=0;
                                    }else{
                                        $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM anggota WHERE kontak='$kontak'"));
                                    }
                                    if($EmailLama==$email){
                                        $ValidasiEmailDuplikat=0;
                                    }else{
                                        $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM anggota WHERE email='$email'"));
                                    }
                                    if(!empty($ValidasiEmailDuplikat)){
                                        echo '<code class="text-danger">Email yang anda masukan sudah ada sebelumnya</code>';
                                    }else{
                                        if(!empty($ValidasiKontakDuplikat)){
                                            echo '<code class="text-danger">Kontak yang anda masukan sudah ada sebelumnya</code>';
                                        }else{
                                            //Validasi kontak tidak boleh lebih dari 20 karakter
                                            if(!preg_match("/^[^a-zA-Z ]*$/", $_POST['kontak'])){
                                                echo '<small class="text-danger">Kontak maksimal 20 karakter numerik</small>';
                                            }else{
                                                //Validasi Gambar
                                                if(!empty($_FILES['foto']['name'])){
                                                    $nama_gambar=$_FILES['foto']['name'];
                                                    $ukuran_gambar = $_FILES['foto']['size']; 
                                                    $tipe_gambar = $_FILES['foto']['type']; 
                                                    $tmp_gambar = $_FILES['foto']['tmp_name'];
                                                    $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                                    $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                                    $FileNameRand=$key;
                                                    $Pecah = explode("." , $nama_gambar);
                                                    $BiasanyaNama=$Pecah[0];
                                                    $Ext=$Pecah[1];
                                                    $namabaru = "$FileNameRand.$Ext";
                                                    $path = "../../assets/img/Anggota/".$namabaru;
                                                    if($tipe_gambar == "image/jpeg"||$tipe_gambar == "image/jpg"||$tipe_gambar == "image/gif"||$tipe_gambar == "image/png"){
                                                        if($ukuran_gambar<2000000){
                                                            if(move_uploaded_file($tmp_gambar, $path)){
                                                                $ValidasiGambar="Valid";
                                                            }else{
                                                                $ValidasiGambar="Upload file gambar gagal";
                                                            }
                                                        }else{
                                                            $ValidasiGambar="File gambar tidak boleh lebih dari 2 mb";
                                                        }
                                                    }else{
                                                        $ValidasiGambar="tipe file hanya boleh JPG, JPEG, PNG and GIF";
                                                    }
                                                }else{
                                                    $ValidasiGambar="Valid";
                                                    $namabaru="$FotoLama";
                                                }
                                                //Apabila validasi upload valid maka simpan di database
                                                if($ValidasiGambar!=="Valid"){
                                                    echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                                                }else{
                                                    $UpdateAnggota = mysqli_query($Conn,"UPDATE anggota SET 
                                                        id_supervisi='$id_supervisi',
                                                        nama='$nama',
                                                        email='$email',
                                                        password='$password',
                                                        kontak='$kontak',
                                                        foto='$namabaru',
                                                        status='$status'
                                                    WHERE id_anggota='$id_anggota'") or die(mysqli_error($Conn)); 
                                                    if($UpdateAnggota){
                                                        $KategoriLog="Customer Service";
                                                        $KeteranganLog="Edit Customer Service Berhasil";
                                                        include "../../_Config/InputLog.php";
                                                        echo '<small class="text-success" id="NotifikasiEditAnggotaBerhasil">Success</small>';
                                                    }else{
                                                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
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