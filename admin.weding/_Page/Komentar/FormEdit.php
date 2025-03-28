<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Session.php";
    if(empty($SessionIdAkses)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center">';
        echo '      <small class="text-danger">Sesi Akses Sudah Berakhir, Silahkan Login Ulang</small>';
        echo '  </div>';
        echo '</div>';
    }else{
        //Tangkap id
        if(empty($_POST['id_komentar'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 mb-3 text-center">';
            echo '      <small class="text-danger">ID Komentar Tidak Boleh Kosong!</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_komentar=$_POST['id_komentar'];
            $id_komentar=validateAndSanitizeInput($id_komentar);
            $id_komentar=validateAndSanitizeInput($id_komentar);
            //Buka Informasi
            $nama=GetDetailData($Conn,'testimoni','id',$id_komentar,'nama');
            $pesan=GetDetailData($Conn,'testimoni','id',$id_komentar,'pesan');
            $datetime=GetDetailData($Conn,'testimoni','id',$id_komentar,'datetime');
            $status=GetDetailData($Conn,'testimoni','id',$id_komentar,'status');
            if($status=="Draft"){
                $LabelStatus='<span class="text-danger">Draft</span>';
            }else{
                $LabelStatus='<span class="text-success">Publish</span>';
            }
            $strtotime=strtotime($datetime);
            $DatetimeFormat=date('d/m/Y H:i', $strtotime);
?>
    <input type="hidden" name="id_komentar" value="<?php echo $id_komentar; ?>">
    <div class="row mb-3">
        <div class="col col-md-4">Nama</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $nama; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Datetime</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $DatetimeFormat; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Pesan</div>
        <div class="col col-md-8">
            <code class="text text-grayish"><?php echo $pesan; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">
            <label for="status">Status</label>
        </div>
        <div class="col-md-8">
            <select name="status" id="status" class="form-control">
                <option <?php if($status=="Publish"){echo "selected";} ?> value="Publish">Publish</option>
                <option <?php if($status=="Draft"){echo "selected";} ?> value="Draft">Draft</option>
            </select>
        </div>
    </div>
<?php 
        }
    }
?>