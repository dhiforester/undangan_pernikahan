<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Kontak yang sudah dihubungi
    $JumlahTotal=mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak"));
    $sudah_dihubungi=mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak WHERE id_anggota!='0'"));
    $belum_dihubungi=mysqli_num_rows(mysqli_query($Conn, "SELECT id_kontak FROM kontak WHERE id_anggota='0'"));
    //Persentase
    $sh_persen=($sudah_dihubungi/$JumlahTotal)*100;
    $sh_persen=round($sh_persen);
    $bd_persen=($belum_dihubungi/$JumlahTotal)*100;
    $bd_persen=round($bd_persen);
    $data = [
        'labels' => ['Sudah ('.$sh_persen.'%)', 'Belum ('.$bd_persen.'%)'],
        'series' => [$sudah_dihubungi, $belum_dihubungi]
    ];
    echo json_encode($data);
?>
