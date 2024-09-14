<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['keyword_by'])){
        echo '<input type="text" name="keyword" id="keyword" class="form-control">';
    }else{
        $keyword_by=$_POST['keyword_by'];
        if($keyword_by=="kategori"){
            echo '<select name="keyword" id="keyword" class="form-control">';
            echo '  <option value="">Pilih</option>';
            $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM kontak ORDER BY kategori ASC");
            while ($data = mysqli_fetch_array($query)) {
                $kategori= $data['kategori'];
                echo '  <option value="'.$kategori.'">'.$kategori.'</option>';
            }
            echo '</select>';
        }else{
            if($keyword_by=="sudah_dihubungi"){
                echo '<select name="keyword" id="keyword" class="form-control">';
                echo '  <option value="Belum">Belum</option>';
                echo '  <option value="Sudah">Sudah</option>';
                echo '</select>';
            }else{
                echo '<input type="text" name="keyword" id="keyword" class="form-control">';
            }
        }
    }
?>