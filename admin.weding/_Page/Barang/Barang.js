function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $.ajax({
        type: 'POST',
        url: '_Page/Barang/TabelBarang.php',
        data: ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelBarang').html(data);
        }
    });
}
$('#ProsesFilter').submit(function(){
    $('#page').val("1");
    filterAndLoadTable();
    $('#ModalFilter').modal('hide');
});
$('#keyword_by').change(function(){
    var keyword_by = $('#keyword_by').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Barang/FormFilter.php',
        data 	    :  {keyword_by: keyword_by},
        success     : function(data){
            $('#FormFilter').html(data);
        }
    });
});
$(document).ready(function() {
    filterAndLoadTable();
});
//Detail Barang
$('#ModalDetailBarang').on('show.bs.modal', function (e) {
    var id_barang= $(e.relatedTarget).data('id');
    $('#FormDetailBarang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Barang/FormDetailBarang.php',
        data        : {id_barang: id_barang},
        success     : function(data){
            $('#FormDetailBarang').html(data);
        }
    });
});
$('#berat').on('input', function() {
    // Ambil nilai dari input
    var value = $(this).val();
    // Gunakan regex untuk membatasi input hanya pada angka dan desimal dengan 2 angka setelah koma
    var valid = value.match(/^\d+(\.\d{0,2})?$/);
    if (valid) {
        // Jika input valid, biarkan nilai tetap
        $(this).val(value);
    } else {
        // Jika input tidak valid, hapus karakter terakhir
        $(this).val(value.slice(0, -1));
    }
});
//Proses Tambah Barang
$('#ProsesTambahBarang').submit(function(){
    $('#NotifikasiTambahBarang').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahBarang')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Barang/ProsesTambahBarang.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahBarang').html(data);
            var NotifikasiTambahBarangBerhasil=$('#NotifikasiTambahBarangBerhasil').html();
            if(NotifikasiTambahBarangBerhasil=="Success"){
                $('#NotifikasiTambahBarang').html('');
                $('#page').val("1");
                $("#ProsesFilter")[0].reset();
                $("#ProsesTambahBarang")[0].reset();
                $('#ModalTambahBarang').modal('hide');
                Swal.fire(
                    'Success!',
                    'Tambah Barang Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Detail Barang
$('#ModalDetail').on('show.bs.modal', function (e) {
    var id_barang= $(e.relatedTarget).data('id');
    $('#FormDetailBarang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Barang/FormDetailBarang.php',
        data        : {id_barang: id_barang},
        success     : function(data){
            $('#FormDetailBarang').html(data);
        }
    });
});
//Edit Barang
$('#ModalEdit').on('show.bs.modal', function (e) {
    var id_barang= $(e.relatedTarget).data('id');
    $('#FormEditBarang').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Barang/FormEditBarang.php',
        data        : {id_barang: id_barang},
        success     : function(data){
            $('#FormEditBarang').html(data);
        }
    });
});
//Proses Edit Barang
$('#ProsesEditBarang').submit(function(){
    $('#NotifikasiEditBarang').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditBarang')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Barang/ProsesEditBarang.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditBarang').html(data);
            var NotifikasiEditBarangBerhasil=$('#NotifikasiEditBarangBerhasil').html();
            if(NotifikasiEditBarangBerhasil=="Success"){
                $('#NotifikasiEditBarang').html('');
                $("#ProsesEditBarang")[0].reset();
                $('#ModalEdit').modal('hide');
                Swal.fire(
                    'Success!',
                    'Edit Barang Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Hapus Barang
$('#ModalHapus').on('show.bs.modal', function (e) {
    var id_barang= $(e.relatedTarget).data('id');
    $('#FormHapus').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Barang/FormHapus.php',
        data        : {id_barang: id_barang},
        success     : function(data){
            $('#FormHapus').html(data);
        }
    });
});
//Proses Hapus
$('#ProsesHapus').submit(function(){
    $('#NotifikkasiHapus').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapus')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Barang/ProsesHapus.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikkasiHapus').html(data);
            var NotifikkasiHapusBerhasil=$('#NotifikkasiHapusBerhasil').html();
            if(NotifikkasiHapusBerhasil=="Success"){
                $('#NotifikkasiHapus').html('');
                $("#ProsesHapus")[0].reset();
                $('#ModalHapus').modal('hide');
                Swal.fire(
                    'Success!',
                    'Hapus Barang Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});