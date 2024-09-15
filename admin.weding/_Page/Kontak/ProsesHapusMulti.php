<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Apakah ada data yang dipilih
    if(empty($_POST['check_id_kontak'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center textdanger">';
        echo '      <code class="text-danger">Proses tidak dilanjutkan karena idak ada data yang dipilih</code>';
        echo '  </div>';
        echo '</div>';
    }else{
        $check_id_kontak=$_POST['check_id_kontak'];
        if (isset($_POST['check_id_kontak'])) {
            // Mengambil data yang di-check
            $checkedKontak = $_POST['check_id_kontak'];
            // Membuat query untuk menghapus data berdasarkan ID
            $idsToDelete = implode(',', $checkedKontak); // Menggabungkan ID kontak menjadi string
            $query = "DELETE FROM kontak WHERE id_kontak IN ($idsToDelete)";
            if (mysqli_query($Conn, $query)) {
                //Apabila Ada File Foto Maka Di Hapus
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Kontak','Hapus Kontak Multi');
                if($SimpanLog=="Success"){
                    echo '<small class="text-success" id="NotifikasiHapusMultiBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan log</small>';
                }
            } else {
                echo "Gagal menghapus data: " . mysqli_error($Conn);
            }
        } else {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center textdanger">';
            echo '      <code class="text-danger">Proses tidak dilanjutkan karena idak ada data yang dipilih</code>';
            echo '  </div>';
            echo '</div>';
        }
    }
?>