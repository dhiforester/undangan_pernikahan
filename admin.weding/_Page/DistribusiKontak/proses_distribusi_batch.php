<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    date_default_timezone_set("Asia/Jakarta");
    // Ambil data dari request
    $tanggal = $_POST['tanggal'];
    $per_cs = $_POST['per_cs'];
    //Menentukkan CS yang Belum Punya Kontak
    $query = "
        SELECT a.* 
        FROM anggota a 
        LEFT JOIN distribusi_kontak d 
        ON a.id_anggota = d.id_anggota AND d.tanggal = ?
        WHERE d.id_anggota IS NULL 
        AND a.status = 'Aktif'
        ORDER BY RAND() 
        LIMIT 1
    ";

    // Siapkan statement
    $stmt = $Conn->prepare($query);
    $stmt->bind_param('s', $tanggal);
    $stmt->execute();
    // Ambil hasil query
    $result = $stmt->get_result();
    $DataCs = $result->fetch_assoc();
    // Periksa apakah ada anggota yang ditemukan
    if ($DataCs) {
        $id_anggota = $DataCs['id_anggota'];
        $nama=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'nama');
        $email=GetDetailData($Conn,'anggota','id_anggota',$id_anggota,'email');
        //Lakukan Looping sebanyak perCs
        $dataList = array();
        $JumlahKontak=0;
        for($i=1; $i<=$per_cs; $i++){
            //Mengambil Data Kontak Secara Acak
            $QryKontak = mysqli_query($Conn,"SELECT * FROM kontak WHERE id_anggota='0' ORDER BY RAND() LIMIT 1")or die(mysqli_error($Conn));
            $DataKontak = mysqli_fetch_array($QryKontak);
            $id_kontak=$DataKontak['id_kontak'];
            $kontak=$DataKontak['kontak'];
            //Update kontak tersebut dengan ID Anggota bersangkutan
            $Update = mysqli_query($Conn,"UPDATE kontak SET 
                id_anggota='$id_anggota'
            WHERE id_kontak='$id_kontak'") or die(mysqli_error($Conn)); 
            if($Update){
                $dataList[] = array(
                    'id_anggota' => $id_anggota,
                    'id_kontak' => $id_kontak,
                    'kontak' => $kontak
                );
                $JumlahKontak=$JumlahKontak+1;
            }else{
                $JumlahKontak=$JumlahKontak+0;
            }
        }
        //Buat Json
        $jsonData = json_encode($dataList, JSON_PRETTY_PRINT);
        //Simpan Data Distribusi
        //Cek Keberadaan Data Distribusi Kontak
        $QryDuplikat = mysqli_query($Conn,"SELECT * FROM distribusi_kontak WHERE id_anggota='$id_anggota' AND tanggal='$tanggal'")or die(mysqli_error($Conn));
        $DataDuplikat = mysqli_fetch_array($QryDuplikat);
        if(empty($DataDuplikat['id_distribusi_kontak'])){
            $Entry="INSERT INTO distribusi_kontak (
                id_anggota,
                tanggal,
                distribusi,
                list_kontak
            ) VALUES (
                '$id_anggota',
                '$tanggal',
                '$JumlahKontak',
                '$jsonData'
            )";
            $Input=mysqli_query($Conn, $Entry);
            if($Input){
                $StatusProses='<code class="text-success">Berhasil</code>';
            }else{
                $StatusProses='<code class="text-danger">Gagal</code>';
            }
        }else{
            $UpdateDistribusi = mysqli_query($Conn,"UPDATE distribusi_kontak SET 
                distribusi='$JumlahKontak',
                list_kontak='$jsonData'
            WHERE id_anggota='$id_anggota' AND tanggal='$tanggal'") or die(mysqli_error($Conn)); 
            if($UpdateDistribusi){
                $StatusProses='<code class="text-success">Berhasil</code>';
            }else{
                $StatusProses='<code class="text-danger">Gagal</code>';
            }
        }
        echo '<tr>';
        echo '  <td>'.$nama.'</td>';
        echo '  <td>'.$email.'</td>';
        echo '  <td>'.$JumlahKontak.'</td>';
        echo '  <td class="text-center">'.$StatusProses.'</td>';
        echo '</tr>';
    } else {
        echo '<tr>';
        echo '  <td colspan="4" class="text-danger text-center">Tidak ada anggota yang belum terdaftar pada tanggal tersebut.</td>';
        echo '</tr>';
    }
?>