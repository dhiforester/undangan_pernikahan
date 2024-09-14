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
            echo '<code class="text-danger">ID Tidak Boleh Kosong</code>';
        }else{
            $id_anggota=$_POST['id_anggota'];
            $id_anggota=validateAndSanitizeInput($id_anggota);
            //Validasi ID Anggota
            $id_anggota=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'id_anggota');
            if(empty($id_anggota)){
                echo '<code class="text-danger">ID Tidak Tidak Valid Atau Tidak Ditemukan Pada Database</code>';
            }else{
                $FotoLama=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'foto');
                $LokasiFotoLama = "../../assets/img/Anggota/".$FotoLama;
                //Hapud Data Anggota
                $HapusAnggota = mysqli_query($Conn, "DELETE FROM anggota WHERE id_anggota='$id_anggota'") or die(mysqli_error($Conn));
                if($HapusAnggota) {
                    //Apabila Ada File Foto Maka Di Hapus
                    if(!empty($FotoLama)){
                        if (file_exists($LokasiFotoLama)) {
                            if (unlink($LokasiFotoLama)) {
                                $ValidasiGambar="Valid";
                            } else {
                                $ValidasiGambar="Terjadi Kesalahan Pada Saat Menghapus File Foto Sebelumnya";
                            }
                        }else{
                            $ValidasiGambar="Valid";
                        }
                    }else{
                        $ValidasiGambar="Valid";
                    }
                    if($ValidasiGambar=="Valid"){
                        $KategoriLog="Customer Service";
                        $KeteranganLog="Hapus Customer Service";
                        include "../../_Config/InputLog.php";
                        echo '<small class="text-success" id="NotifikasiHapusAnggotaBerhasil">Success</small>';
                    }else{
                        echo '<code class="text-danger">'.$ValidasiGambar.'</code>';
                    }
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan Pada Saat Menghapus Data</code>';
                }
            }
        }
    }
?>