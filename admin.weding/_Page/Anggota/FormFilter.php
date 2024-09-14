<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['keyword_by'])){
        echo '<label for="keyword">Kata Kunci</label>';
        echo '<input type="text" name="keyword" id="keyword" class="form-control">';
    }else{
        $keyword_by=$_POST['keyword_by'];
        if($keyword_by=="id_supervisi"){
            echo '<label for="keyword">Kata Kunci</label>';
            echo '<select name="keyword" id="keyword" class="form-control">';
            echo '  <option value="">Pilih</option>';
            $query = mysqli_query($Conn, "SELECT id_supervisi, nama FROM supervisi ORDER BY nama ASC");
            while ($data = mysqli_fetch_array($query)) {
                $id_supervisi= $data['id_supervisi'];
                $nama= $data['nama'];
                echo '  <option value="'.$id_supervisi.'">'.$nama.'</option>';
            }
            echo '</select>';
        }else{
            if($keyword_by=="status"){
                echo '<label for="keyword">Kata Kunci</label>';
                echo '<select name="keyword" id="keyword" class="form-control">';
                echo '  <option value="">Pilih</option>';
                $query = mysqli_query($Conn, "SELECT DISTINCT status FROM anggota ORDER BY status ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $status= $data['status'];
                    echo '  <option value="'.$status.'">'.$status.'</option>';
                }
                echo '</select>';
            }else{
                echo '<label for="keyword">Kata Kunci</label>';
                echo '<input type="text" name="keyword" id="keyword" class="form-control">';
            }
        }
    }
?>