<?php
    include "../../_Config/Connection.php";
    if(!empty($_POST['keyword_by'])){
        $KeywordBy=$_POST['keyword_by'];
        if($KeywordBy=="kode"){
            echo ' <input type="text" name="keyword" id="keyword" class="form-control">';
        }else{
            if($KeywordBy=="nama"){
                echo ' <input type="text" name="keyword" id="keyword" class="form-control">';
            }else{
                if($KeywordBy=="kategori"){
                    echo '<select name="keyword" id="keyword" class="form-control">';
                    $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM barang ORDER BY kategori ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $kategori= $data['kategori'];
                        echo '  <option value="'.$kategori.'">'.$kategori.'</option>';
                    }
                    echo '</select>';
                }else{
                    if($KeywordBy=="satuan"){
                        echo '<select name="keyword" id="keyword" class="form-control">';
                        $query = mysqli_query($Conn, "SELECT DISTINCT satuan FROM barang ORDER BY satuan ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $satuan= $data['satuan'];
                            echo '  <option value="'.$satuan.'">'.$satuan.'</option>';
                        }
                        echo '</select>';
                    }else{
                        if($KeywordBy=="harga"){
                            echo ' <input type="number" name="keyword" id="keyword" class="form-control">';
                        }else{
                            if($KeywordBy=="stok"){
                                echo ' <input type="number" name="keyword" id="keyword" class="form-control">';
                            }else{
                                echo ' <input type="text" name="keyword" id="keyword" class="form-control">';
                            }
                        }
                    }
                }
            }
        }
    }else{
        echo ' <input type="text" name="keyword" id="keyword" class="form-control">';
    }
?>