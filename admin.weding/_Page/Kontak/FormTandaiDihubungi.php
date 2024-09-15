<?php
    if(empty($_POST['check_id_kontak'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center textdanger">';
        echo '      <span class="text-danger">Tidak ada data yang dipilih</span>';
        echo '  </div>';
        echo '</div>';
        
    }else{
        $check_id_kontak=$_POST['check_id_kontak'];
        $JumlahData=count($check_id_kontak);
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center textdanger">';
        echo '      <h3>'.$JumlahData.' Data</h3>';
        echo '      <small>Apakah anda yakin akan menandai data kontak tersebut?</small>';
        echo '  </div>';
        echo '</div>';
        
    }
?>