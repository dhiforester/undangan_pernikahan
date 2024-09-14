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
            //Validasi id_kontak tidak boleh kosong
            if(empty($_POST['id_kontak'])){
                echo '<code class="text-danger">ID Kontak tidak boleh kosong</code>';
            }else{
                //Validasi kategori tidak boleh kosong
                if(empty($_POST['kategori'])){
                    echo '<code class="text-danger">Kategori kontak tidak boleh kosong</code>';
                }else{
                    //Buat Variabel
                    $id_kontak=$_POST['id_kontak'];
                    $nama=$_POST['nama'];
                    if(empty($_POST['kontak'])){
                        $kontak="";
                    }else{
                        $kontak=$_POST['kontak'];
                    }
                    if(empty($_POST['email'])){
                        $email="";
                    }else{
                        $email=$_POST['email'];
                    }
                    if(empty($_POST['alamat'])){
                        $alamat="";
                    }else{
                        $alamat=$_POST['alamat'];
                    }
                    if(empty($_POST['sudah_dihubungi'])){
                        $sudah_dihubungi="Belum";
                    }else{
                        $sudah_dihubungi=$_POST['sudah_dihubungi'];
                    }
                    $kategori=$_POST['kategori'];
                    //Bersihkan Variabel
                    $nama=validateAndSanitizeInput($nama);
                    $kontak=validateAndSanitizeInput($kontak);
                    $email=validateAndSanitizeInput($email);
                    $alamat=validateAndSanitizeInput($alamat);
                    $kategori=validateAndSanitizeInput($kategori);
                    $sudah_dihubungi=validateAndSanitizeInput($sudah_dihubungi);
                    if (!ctype_digit($kontak) && strlen($kontak) > 20) {
                        echo '<small class="text-danger">Kontak maksimal 20 karakter numerik</small>';
                    }else{
                        if(strlen($kategori) > 50) {
                            echo '<small class="text-danger">Kategori maksimal 50 karakter</small>';
                        }else{
                            $UpdateKontak = mysqli_query($Conn,"UPDATE kontak SET 
                                nama='$nama',
                                email='$email',
                                kontak='$kontak',
                                alamat='$alamat',
                                kategori='$kategori',
                                sudah_dihubungi='$sudah_dihubungi'
                            WHERE id_kontak='$id_kontak'") or die(mysqli_error($Conn)); 
                            if($UpdateKontak){
                                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Kontak','Edit Kontak');
                                if($SimpanLog=="Success"){
                                    echo '<small class="text-success" id="NotifikasiEditBerhasil">Success</small>';
                                }else{
                                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan log</small>';
                                }
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data anggota</small>';
                            }
                        }
                    }
                }
            }
        }
    }
?>