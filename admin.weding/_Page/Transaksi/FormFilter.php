<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['keyword_by'])){
        echo '<input type="text" name="keyword" id="keyword" class="form-control">';
    }else{
        $keyword_by=$_POST['keyword_by'];
        if($keyword_by=="datetime_transaksi"){
            echo '<input type="date" name="keyword" id="keyword" class="form-control">';
        }else{
            if($keyword_by=="id_supervisi"){
                echo '<select name="keyword" id="keyword" class="form-control">';
                echo '  <option value="">Pilih</option>';
                $query = mysqli_query($Conn, "SELECT DISTINCT id_supervisi FROM transaksi ORDER BY id_supervisi ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $id_supervisi= $data['id_supervisi'];
                    $nama=GetDetailData($Conn,'supervisi','id_supervisi',$id_supervisi,'nama');
                    echo '  <option value="'.$id_supervisi.'">'.$nama.'</option>';
                }
                echo '</select>';
            }else{
                if($keyword_by=="status_pembayaran"){
                    echo '<select name="keyword" id="keyword" class="form-control">';
                    echo '  <option value="">Pilih</option>';
                    $query = mysqli_query($Conn, "SELECT DISTINCT status_pembayaran FROM transaksi ORDER BY status_pembayaran ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $status_pembayaran= $data['status_pembayaran'];
                        echo '  <option value="'.$status_pembayaran.'">'.$status_pembayaran.'</option>';
                    }
                    echo '</select>';
                }else{
                    if($keyword_by=="status_pengiriman"){
                        echo '<select name="keyword" id="keyword" class="form-control">';
                        echo '  <option value="">Pilih</option>';
                        $query = mysqli_query($Conn, "SELECT DISTINCT status_pengiriman FROM transaksi ORDER BY status_pengiriman ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $status_pengiriman= $data['status_pengiriman'];
                            echo '  <option value="'.$status_pengiriman.'">'.$status_pengiriman.'</option>';
                        }
                        echo '</select>';
                    }else{
                        echo '<input type="text" name="keyword" id="keyword" class="form-control">';
                    }
                }
            }
        }
    }
?>