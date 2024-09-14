<?php
    include "../../_Config/Connection.php";
    $QryKategori = mysqli_query($Conn, "SELECT kategori FROM kontak ORDER BY kategori ASC");
    while ($DataKategori = mysqli_fetch_array($QryKategori)) {
        $kategori= $DataKategori['kategori'];
        echo '<option value="'.$kategori.'">'.$kategori.'</option>';
    }
?>