$(document).ready(function() {
    // Fungsi untuk menampilkan rekap distribusi
    function ShowRekapDistribusi() {
        $.ajax({
            type: 'POST',
            url: '_Page/DistribusiKontak/RekapDistribusi.php',
            success: function(data) {
                $('#RekapDistribusi').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                $('#RekapDistribusi').html('<p class="text-danger">Gagal memuat rekap distribusi.</p>');
            }
        });
    }
    // Fungsi untuk menampilkan riwayat distribusi
    function RiwayatDistribusi() {
        $.ajax({
            type: 'POST',
            url: '_Page/DistribusiKontak/RiwayatDistribusi.php',
            success: function(data) {
                $('#MenampilkanRiwayatDistribusi').html(data);
            }
        });
    }
    // Fungsi untuk memproses batch distribusi
    function prosesBatch(tanggal, perCs) {
        $.ajax({
            url: '_Page/DistribusiKontak/proses_distribusi_batch.php', // URL ke file PHP yang memproses batch
            method: 'POST',
            data: { tanggal: tanggal, per_cs: perCs },
            success: function(data) {
                // Tambahkan hasil ke dalam tbody
                $('#HasilDistribusi').append(data);
                
                // Cek apakah masih ada data yang belum diproses
                cekProgres(tanggal, perCs);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                $('#HasilDistribusi').append('<tr><td colspan="4" class="text-center text-danger">Gagal memproses batch.</td></tr>');
            }
        });
    }

    // Fungsi untuk mengecek progres
    function cekProgres(tanggal, perCs) {
        $.ajax({
            type: 'POST',
            url: '_Page/DistribusiKontak/CekProgres.php',
            data: { tanggal: tanggal },
            success: function(response) {
                if (response.trim() === "Ada") {
                    // Panggil lagi prosesBatch untuk batch berikutnya
                    prosesBatch(tanggal, perCs);
                } else {
                    $('#NotifikasiProsesBatch').html('<code class="text-success">Proses Selesai</code>');
                    Swal.fire(
                        'Success!',
                        'Distribusi selesai!',
                        'success'
                    );
                    ShowRekapDistribusi();
                    RiwayatDistribusi();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire(
                    'Error',
                    'Gagal memeriksa progres distribusi.',
                    'error'
                );
            }
        });
    }

    // Membuka rekap distribusi pertama kali
    ShowRekapDistribusi();
    RiwayatDistribusi();

    // Event handler untuk submit form
    $('#ProsesDistribusi').on('submit', function(e) {
        e.preventDefault(); // Mencegah submit form secara default
        
        // Inisialisasi variabel
        var tanggal = $('#tanggal').val();
        var perCs = $('#per_cs').val();
        
        // Mengosongkan hasil sebelumnya
        $('#NotifikasiProsesBatch').html('<code class="text-info">Memproses...</code>');
        
        // Panggil fungsi untuk mulai memproses batch
        prosesBatch(tanggal, perCs);
    });
    //Ketika menghapus anggota dari kontak
    $('#ProsesHapusAnggotaDariKontak').on('submit', function(e) {
        $('#NotifikasiHapusAnggotaDariKontak').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
        var form = $('#ProsesHapusAnggotaDariKontak')[0];
        var data = new FormData(form);
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/DistribusiKontak/ProsesHapusAnggotaDariKontak.php',
            data 	    :  data,
            cache       : false,
            processData : false,
            contentType : false,
            enctype     : 'multipart/form-data',
            success     : function(data){
                $('#NotifikasiHapusAnggotaDariKontak').html(data);
                var NotifikasiHapusAnggotaDariKontakBerhasil=$('#NotifikasiHapusAnggotaDariKontakBerhasil').html();
                if(NotifikasiHapusAnggotaDariKontakBerhasil=="Success"){
                    $('#NotifikasiHapusAnggotaDariKontak').html('');
                    $('#HasilDistribusi').html('');
                    $('#ModalHapusAnggotaDariKontak').modal('hide');
                    Swal.fire(
                        'Success!',
                        'Hapus CS dari Kontak Berhasil!',
                        'success'
                    )
                    //Menampilkan Data
                    ShowRekapDistribusi();
                    RiwayatDistribusi();
                }
            }
        });
    });
});
