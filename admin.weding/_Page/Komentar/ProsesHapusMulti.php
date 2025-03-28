<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Apakah ada data yang dipilih
    if(empty($_POST['check_id_Komentar'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center textdanger">';
        echo '      <code class="text-danger">Proses tidak dilanjutkan karena idak ada data yang dipilih</code>';
        echo '  </div>';
        echo '</div>';
    }else{
        $check_id_Komentar=$_POST['check_id_Komentar'];
        if (isset($_POST['check_id_Komentar'])) {
            // Mengambil data yang di-check
            $id = $_POST['check_id_Komentar'];
            // Membuat query untuk menghapus data berdasarkan ID
            $idsToDelete = implode(',', $id); // Menggabungkan ID Komentar menjadi string
            $query = "DELETE FROM testimoni WHERE id IN ($idsToDelete)";
            if (mysqli_query($Conn, $query)) {
                //Apabila Ada File Foto Maka Di Hapus
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Komentar','Hapus Komentar Multi');
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