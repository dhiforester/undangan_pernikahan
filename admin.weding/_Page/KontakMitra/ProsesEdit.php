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
                //Validasi id_kontak tidak boleh kosong
                if(empty($_POST['id_kontak'])){
                    echo '<code class="text-danger">ID kontak tidak boleh kosong</code>';
                }else{
                    //Buat Variabel
                    $id_kontak=$_POST['id_kontak'];
                    $nama=$_POST['nama'];
                    $kontak=$_POST['kontak'];
                    if(empty($_POST['email'])){
                        $email="";
                    }else{
                        $email=$_POST['email'];
                    }
                    if(empty($_POST['sudah_dihubungi'])){
                        $sudah_dihubungi="0";
                    }else{
                        $sudah_dihubungi=$_POST['sudah_dihubungi'];
                    }
                    //Bersihkan Variabel
                    $id_kontak=validateAndSanitizeInput($id_kontak);
                    $nama=validateAndSanitizeInput($nama);
                    $kontak=validateAndSanitizeInput($kontak);
                    $email=validateAndSanitizeInput($email);
                    $sudah_dihubungi=validateAndSanitizeInput($sudah_dihubungi);
                    //Buka data lama
                    $kontak_lama=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'kontak');
                    //Validasi Duplikat
                    if($kontak_lama==$kontak){
                        $ValidasiKontakDuplikat=0;
                    }else{
                        $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM kontak WHERE kontak='$kontak'"));
                    }
                    
                    if(!empty($ValidasiKontakDuplikat)){
                        echo '<code class="text-danger">Kontak yang anda masukan sudah ada sebelumnya</code>';
                    }else{
                        //Validasi kontak tidak boleh lebih dari 20 karakter
                        if(!preg_match("/^[^a-zA-Z ]*$/", $_POST['kontak'])){
                            echo '<small class="text-danger">Kontak maksimal 20 karakter numerik</small>';
                        }else{
                            $Update = mysqli_query($Conn,"UPDATE kontak SET 
                                nama='$nama',
                                email='$email',
                                kontak='$kontak',
                                sudah_dihubungi='$sudah_dihubungi'
                            WHERE id_kontak='$id_kontak'") or die(mysqli_error($Conn)); 
                            if($Update){
                                $KategoriLog="Kontak";
                                $KeteranganLog="Edit Kontak baru";
                                include "../../_Config/InputLog.php";
                                echo '<small class="text-success" id="NotifikasiEditBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data kontak</small>';
                            }
                        }
                    }
                }
            }
        }
    }
?>