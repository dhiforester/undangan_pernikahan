<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['keyword_by'])){
        echo '<input type="text" name="keyword" id="keyword" class="form-control">';
    }else{
        $keyword_by=$_POST['keyword_by'];
        if($keyword_by=="status"){
            echo '<select name="keyword" id="keyword" class="form-control">';
            echo '  <option value="Publish">Publish</option>';
            echo '  <option value="Draft">Draft</option>';
            echo '</select>';
        }else{
            if($keyword_by=="datetime"){
                echo '<input type="date" name="keyword" id="keyword" class="form-control">';
            }else{
                echo '<input type="text" name="keyword" id="keyword" class="form-control">';
            }
        }
    }
?>