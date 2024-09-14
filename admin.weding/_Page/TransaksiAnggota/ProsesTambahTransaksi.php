<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/GlobalFunction.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($SessionIdAkses)){
        echo '<small class="text-danger">Sessi Akses Sudah Berakhir, Silahkan Login Ulang!</small>';
    }else{
        if(empty($_POST['nama'])){
            echo '<small class="text-danger">Nama Pelanggan/Penerima Tidak Boleh Kosong</small>';
        }else{
            if(empty($_POST['alamat'])){
                echo '<small class="text-danger">Alamat Pengiriman Tidak Boleh Kosong</small>';
            }else{
                if(empty($_POST['provinsi'])){
                    echo '<small class="text-danger">Provinsi Tidak Boleh Kosong</small>';
                }else{
                    if(empty($_POST['kabupaten'])){
                        echo '<small class="text-danger">Kabupaten Tidak Boleh Kosong</small>';
                    }else{
                        if(empty($_POST['kecamatan'])){
                            echo '<small class="text-danger">Kecamatan Tidak Boleh Kosong</small>';
                        }else{
                            if(empty($_POST['desa'])){
                                echo '<small class="text-danger">Desa Tidak Boleh Kosong</small>';
                            }else{
                                if(empty($_POST['kode_pos'])){
                                    echo '<small class="text-danger">Kode Pos Tidak Boleh Kosong</small>';
                                }else{
                                    if(empty($_POST['no_kontak'])){
                                        echo '<small class="text-danger">Nomor Kontak Pelanggan Tidak Boleh Kosong</small>';
                                    }else{
                                        if(empty($_POST['nama_produk'])){
                                            echo '<small class="text-danger">Nama Produk Tidak Boleh Kosong</small>';
                                        }else{
                                            if(empty($_POST['berat'])){
                                                echo '<small class="text-danger">Berat Produk Tidak Boleh Kosong</small>';
                                            }else{
                                                if(empty($_POST['qty'])){
                                                    echo '<small class="text-danger">Quantity Tidak Boleh Kosong</small>';
                                                }else{
                                                    //Buat Variabel
                                                    $nama=$_POST['nama'];
                                                    $alamat=$_POST['alamat'];
                                                    $provinsi=$_POST['provinsi'];
                                                    $kabupaten=$_POST['kabupaten'];
                                                    $kecamatan=$_POST['kecamatan'];
                                                    $desa=$_POST['desa'];
                                                    $kode_pos=$_POST['kode_pos'];
                                                    $no_kontak=$_POST['no_kontak'];
                                                    $nama_produk=$_POST['nama_produk'];
                                                    $berat=$_POST['berat'];
                                                    $qty=$_POST['qty'];
                                                    if(empty($_POST['harga_non_cod'])){
                                                        $harga_non_cod="0";
                                                    }else{
                                                        $harga_non_cod=$_POST['harga_non_cod'];
                                                    }
                                                    if(empty($_POST['harga_cod'])){
                                                        $harga_cod="0";
                                                    }else{
                                                        $harga_cod=$_POST['harga_cod'];
                                                    }
                                                    if(empty($_POST['keterangan'])){
                                                        $keterangan="0";
                                                    }else{
                                                        $keterangan=$_POST['keterangan'];
                                                    }
                                                    //Bersihkan Variabel
                                                    $nama=validateAndSanitizeInput($nama);
                                                    $alamat=validateAndSanitizeInput($alamat);
                                                    $provinsi=validateAndSanitizeInput($provinsi);
                                                    $kabupaten=validateAndSanitizeInput($kabupaten);
                                                    $kecamatan=validateAndSanitizeInput($kecamatan);
                                                    $desa=validateAndSanitizeInput($desa);
                                                    $kode_pos=validateAndSanitizeInput($kode_pos);
                                                    $no_kontak=validateAndSanitizeInput($no_kontak);
                                                    $nama_produk=validateAndSanitizeInput($nama_produk);
                                                    $berat=validateAndSanitizeInput($berat);
                                                    $qty=validateAndSanitizeInput($qty);
                                                    $harga_non_cod=validateAndSanitizeInput($harga_non_cod);
                                                    $harga_cod=validateAndSanitizeInput($harga_cod);
                                                    $keterangan=validateAndSanitizeInput($keterangan);
                                                    //Ciptakan uuid
                                                    $uuid_transaksi=GenerateToken(32);
                                                    //Buat JSON
                                                    $data_rincian_transaksi = [
                                                        "nama_produk" => $nama_produk,
                                                        "berat" => $berat,
                                                        "qty" => $qty,
                                                        "harga_non_cod" => $harga_non_cod,
                                                        "harga_cod" => $harga_cod
                                                    ];
                                                    $rincian_transaksi = json_encode($data_rincian_transaksi, JSON_PRETTY_PRINT);
                                                    $data_rincian_pengiriman = [
                                                        "nama" => $nama,
                                                        "alamat" => $alamat,
                                                        "provinsi" => $provinsi,
                                                        "kabupaten" => $kabupaten,
                                                        "kecamatan" => $kecamatan,
                                                        "desa" => $desa,
                                                        "kode_pos" => $kode_pos,
                                                        "no_kontak" => $no_kontak
                                                    ];
                                                    $rincian_pengiriman = json_encode($data_rincian_pengiriman, JSON_PRETTY_PRINT);
                                                    //Mencari SPV
                                                    $id_anggota=GetDetailData($Conn,'anggota','id_anggota',$SessionIdAkses,'id_anggota');
                                                    $id_supervisi=GetDetailData($Conn,'anggota','id_anggota',$SessionIdAkses,'id_supervisi');
                                                    //Mencari ID Kontak
                                                    $id_kontak=GetDetailData($Conn,'kontak','kontak',$no_kontak,'id_kontak');
                                                    $Subtotal=0;
                                                    //Simpan data
                                                    $EntryData="INSERT INTO transaksi (
                                                        uuid_transaksi,
                                                        id_supervisi,
                                                        id_anggota,
                                                        id_kontak,
                                                        datetime_transaksi,
                                                        rincian_transaksi,
                                                        rincian_pengiriman,
                                                        subtotal,
                                                        ppn,
                                                        ongkir,
                                                        jumlah,
                                                        status_pembayaran,
                                                        status_pengiriman
                                                    ) VALUES (
                                                        '$uuid_transaksi',
                                                        '$id_supervisi',
                                                        '$id_anggota',
                                                        '$id_kontak',
                                                        '$now',
                                                        '$rincian_transaksi',
                                                        '$rincian_pengiriman',
                                                        '0',
                                                        '0',
                                                        '0',
                                                        '0',
                                                        'Pending',
                                                        'Pending'
                                                    )";
                                                    $InputData=mysqli_query($Conn, $EntryData);
                                                    if($InputData){
                                                        $_SESSION ["NotifikasiSwal"]="Tambah Transaksi Berhasil";
                                                        echo '<small class="text-success" id="NotifikasiTambahTransaksiBerhasil">Success</small>';
                                                    }else{
                                                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan transaksi</small>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>