<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['keyword_by'])){
        echo '<input type="text" name="keyword" id="keyword" class="form-control">';
    }else{
        $keyword_by=$_POST['keyword_by'];
        if($keyword_by=="sumber"){
            echo '<select name="keyword" id="keyword" class="form-control">';
            echo '  <option value="">Pilih</option>';
            $query = mysqli_query($Conn, "SELECT DISTINCT sumber FROM kontak ORDER BY sumber ASC");
            while ($data = mysqli_fetch_array($query)) {
                $sumber= $data['sumber'];
                echo '  <option value="'.$sumber.'">'.$sumber.'</option>';
            }
            echo '</select>';
        }else{
            if($keyword_by=="sudah_dihubungi"){
                echo '<select name="keyword" id="keyword" class="form-control">';
                echo '  <option value="0">Belum</option>';
                echo '  <option value="1">Sudah</option>';
                echo '</select>';
            }else{
                echo '<input type="text" name="keyword" id="keyword" class="form-control">';
            }
        }
    }
?>