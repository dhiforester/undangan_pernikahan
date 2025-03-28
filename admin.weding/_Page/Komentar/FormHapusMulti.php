<?php
    if(empty($_POST['check_id_Komentar'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center textdanger">';
        echo '      <span class="text-danger">Tidak ada data yang dipilih</span>';
        echo '  </div>';
        echo '</div>';
        
    }else{
        $check_id_Komentar=$_POST['check_id_Komentar'];
        $JumlahData=count($check_id_Komentar);
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center textdanger">';
        echo '      <h3>'.$JumlahData.' Data</h3>';
        echo '      <small>Apakah anda yakin akan menghapus data tersebut?</small>';
        echo '  </div>';
        echo '</div>';
        
    }
?>