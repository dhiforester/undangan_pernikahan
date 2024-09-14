function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $.ajax({
        type: 'POST',
        url: '_Page/Kontak/TabelKontak.php',
        data: ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelKontak').html(data);
        }
    });
}
$(document).ready(function() {
    filterAndLoadTable();
});
$('#keyword_by').change(function(){
    var keyword_by = $('#keyword_by').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kontak/FormFilter.php',
        data 	    :  {keyword_by: keyword_by},
        success     : function(data){
            $('#FormFilter').html(data);
        }
    });
});
$('#ProsesFilter').submit(function(){
    $('#page').val("1");
    filterAndLoadTable();
    $('#ModalFilter').modal('hide');
});
//Validasi Kontak Hanya Boleh Angka
$('#kontak').keypress(function(event) {
    // Hanya mengizinkan angka (0-9) dan tombol kontrol seperti backspace
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
});
//Modal Tambah Kontak
$('#ModalTambah').on('show.bs.modal', function (e) {
    $('#ListKategori').load('_Page/Kontak/ListKategori.php');
});
//Proses Tambah Anggota
$('#ProsesTambah').submit(function(){
    $('#NotifikasiTambah').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambah')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kontak/ProsesTambah.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambah').html(data);
            var NotifikasiTambahBerhasil=$('#NotifikasiTambahBerhasil').html();
            if(NotifikasiTambahBerhasil=="Success"){
                $('#NotifikasiTambah').html('');
                $('#page').val("1");
                $("#ProsesFilter")[0].reset();
                $("#ProsesTambah")[0].reset();
                $('#ModalTambah').modal('hide');
                Swal.fire(
                    'Success!',
                    'Tambah Kontak Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Detail Anggota
$('#ModalDetail').on('show.bs.modal', function (e) {
    var id_kontak= $(e.relatedTarget).data('id');
    $('#FormDetail').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kontak/FormDetail.php',
        data        : {id_kontak: id_kontak},
        success     : function(data){
            $('#FormDetail').html(data);
        }
    });
});
//Modal Edit Anggota
$('#ModalEdit').on('show.bs.modal', function (e) {
    var id_kontak= $(e.relatedTarget).data('id');
    $('#FormEdit').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kontak/FormEdit.php',
        data        : {id_kontak: id_kontak},
        success     : function(data){
            $('#FormEdit').html(data);
            $('#NotifikasiEdit').html('');
        }
    });
});
//Proses Edit Kontak
$('#ProsesEdit').submit(function(){
    $('#NotifikasiEdit').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEdit')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kontak/ProsesEdit.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEdit').html(data);
            var NotifikasiEditBerhasil=$('#NotifikasiEditBerhasil').html();
            if(NotifikasiEditBerhasil=="Success"){
                $('#NotifikasiEdit').html('');
                $("#ProsesEdit")[0].reset();
                $('#ModalEdit').modal('hide');
                Swal.fire(
                    'Success!',
                    'Edit Kontak Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Hapus
$('#ModalHapus').on('show.bs.modal', function (e) {
    var id_kontak= $(e.relatedTarget).data('id');
    $('#FormHapus').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kontak/FormHapus.php',
        data        : {id_kontak: id_kontak},
        success     : function(data){
            $('#FormHapus').html(data);
            $('#NotifikasiHapus').html('');
        }
    });
});
//Proses Hapus Kontak
$('#ProsesHapus').submit(function(){
    $('#NotifikasiHapus').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapus')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kontak/ProsesHapus.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapus').html(data);
            var NotifikasiHapusBerhasil=$('#NotifikasiHapusBerhasil').html();
            if(NotifikasiHapusBerhasil=="Success"){
                $('#NotifikasiHapus').html('');
                $('#ModalHapus').modal('hide');
                Swal.fire(
                    'Success!',
                    'Hapus Kontak Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Proses Import
var totalProcessed = 0; // Menyimpan jumlah data yang telah diproses
var totalData = 0; // Menyimpan jumlah total data untuk impor

function importDataKontak() {
    var currentRow = $('#currentRow').val();
    var form = $('#ProsesImport')[0];
    var data = new FormData(form);
    data.append('currentRow', currentRow);
    data.append('totalProcessed', totalProcessed); // Kirim jumlah data yang telah diproses

    $.ajax({
        type: 'POST',
        url: '_Page/Kontak/ProsesImport.php',
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        success: function(response) {
            $('#NotifikasiProsesImport').append(response);

            // Perbarui progress import
            totalProcessed += 100; // Perkirakan 100 baris per batch
            var progressPercentage = Math.min((totalProcessed / totalData) * 100, 100);
            $('#ProgressProsesImport').html(
                '<code class="text text-dark">Progress: ' + Math.round(progressPercentage) + '%</code>'
            );

            // Periksa jika masih ada data yang harus diimpor
            if (response.indexOf('Lanjutkan') !== -1) {
                // Perbarui baris saat ini untuk impor berikutnya
                $('#currentRow').val(parseInt(currentRow) + 100);
                importDataKontak(); // Panggil fungsi lagi untuk melanjutkan impor
            } else {
                $('#currentRow').val(1); // Reset nilai baris
                totalProcessed = 0; // Reset jumlah data yang telah diproses
                $("#ProsesFilter")[0].reset();
                $('#ProgressProsesImport').html('<code class="text text-dark">Import Selesai</code>');
                filterAndLoadTable();
            }
        }
    });
}

// Fungsi untuk mendapatkan jumlah total data dari file Excel sebelum mulai impor
function getTotalDataCount() {
    var form = $('#ProsesImport')[0];
    var data = new FormData(form);

    $.ajax({
        type: 'POST',
        url: '_Page/Kontak/GetTotalData.php', // Buat file PHP untuk menghitung jumlah total data
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        success: function(response) {
            totalData = parseInt(response); // Simpan jumlah total data untuk progres
            importDataKontak(); // Mulai impor setelah mendapatkan jumlah total data
        }
    });
}

// Panggil fungsi getTotalDataCount saat form di-submit
$('#ProsesImport').submit(function() {
    $('#NotifikasiProsesImport').html(''); // Bersihkan tabel sebelum mulai import
    $('#ProgressProsesImport').html('<code class="text text-dark">Loading...</code>');
    getTotalDataCount(); // Dapatkan jumlah total data dan mulai impor
});