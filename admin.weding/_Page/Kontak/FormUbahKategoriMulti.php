<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Apabila Data Tidak Ada Yang Dipilih
    if(empty($_POST['check_id_kontak'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center textdanger">';
        echo '      <span class="text-danger">Tidak ada data yang dipilih</span>';
        echo '  </div>';
        echo '</div>';
    }else{
        $check_id_kontak=$_POST['check_id_kontak'];
        $JumlahData=count($check_id_kontak);
?>
    <div class="row">
        <div class="col-md-12 border_ungu table table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <td><b>No</b></td>
                        <td><b>Nama</b></td>
                        <td><b>Kategori</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        foreach ($check_id_kontak as $id_kontak) {
                            //Buka Kontak
                            $nama=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'nama');
                            $email=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'email');
                            $kontak=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'kontak');
                            $kategori=GetDetailData($Conn,'kontak','id_kontak',$id_kontak,'kategori');
                            echo '<input type="hidden" name="id_kontak[]" value="'.$id_kontak.'">';
                            echo '<tr>';
                            echo '  <td align="center">'.$no.'</td>';
                            echo '  <td align="left">'.$nama.'</td>';
                            echo '  <td align="left">'.$kategori.'</td>';
                            echo '</tr>';
                            $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-12">
            <label for="kategori_edit_multi">Kategori</label>
            <input type="text" name="kategori" id="kategori_edit_multi" class="form-control" list="ListKategoriEditMulti">
            <datalist id="ListKategoriEditMulti">
                <?php
                    $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori FROM kontak ORDER BY kategori ASC");
                    while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                        $kategori= $DataKategori['kategori'];
                        echo '<option value="'.$kategori.'">'.$kategori.'</option>';
                    }
                ?>
            </datalist>
        </div>
    </div>
<?php
    }
?>