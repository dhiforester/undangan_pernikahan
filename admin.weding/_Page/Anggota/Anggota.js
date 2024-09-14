function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $.ajax({
        type: 'POST',
        url: '_Page/Anggota/TabelAnggota.php',
        data: ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelAnggota').html(data);
        }
    });
}
$(document).ready(function() {
    filterAndLoadTable();
    //Form Password dan tanggal keluar Untuk Pertama Kali
    $('#form_password').hide();
});
$('#keyword_by').change(function(){
    var keyword_by = $('#keyword_by').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggota/FormFilter.php',
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
//Menampilkan Password
$('#tampilkan_password_anggota').click(function(){
    if($(this).is(':checked')){
        $('#password').attr('type','text');
    }else{
        $('#password').attr('type','password');
    }
});
//Proses Tambah Anggota
$('#ProsesTambahAnggota').submit(function(){
    $('#NotifikasiTambahAnggota').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahAnggota')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggota/ProsesTambahAnggota.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahAnggota').html(data);
            var NotifikasiTambahAnggotaBerhasil=$('#NotifikasiTambahAnggotaBerhasil').html();
            if(NotifikasiTambahAnggotaBerhasil=="Success"){
                $('#NotifikasiTambahAnggota').html('');
                $('#page').val("1");
                $("#ProsesFilter")[0].reset();
                $("#ProsesTambahAnggota")[0].reset();
                $('#ModalTambahAnggota').modal('hide');
                Swal.fire(
                    'Success!',
                    'Tambah Customer Service Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Detail Anggota
$('#ModalDetailAnggota').on('show.bs.modal', function (e) {
    var id_anggota= $(e.relatedTarget).data('id');
    $('#FormDetailAnggota').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggota/FormDetailAnggota.php',
        data        : {id_anggota: id_anggota},
        success     : function(data){
            $('#FormDetailAnggota').html(data);
        }
    });
});
//Modal Edit Anggota
$('#ModalEditAnggota').on('show.bs.modal', function (e) {
    var id_anggota= $(e.relatedTarget).data('id');
    $('#FormEditAnggota').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggota/FormEditAnggota.php',
        data        : {id_anggota: id_anggota},
        success     : function(data){
            $('#FormEditAnggota').html(data);
            $('#NotifikasiEditAnggota').html('');
        }
    });
});
//Proses Edit Anggota
$('#ProsesEditAnggota').submit(function(){
    $('#NotifikasiEditAnggota').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditAnggota')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggota/ProsesEditAnggota.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditAnggota').html(data);
            var NotifikasiEditAnggotaBerhasil=$('#NotifikasiEditAnggotaBerhasil').html();
            if(NotifikasiEditAnggotaBerhasil=="Success"){
                $('#NotifikasiEditAnggota').html('');
                $("#ProsesEditAnggota")[0].reset();
                $('#ModalEditAnggota').modal('hide');
                Swal.fire(
                    'Success!',
                    'Edit Customer Service Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Hapus Anggota
$('#ModalHapusAnggota').on('show.bs.modal', function (e) {
    var id_anggota= $(e.relatedTarget).data('id');
    $('#FormHapusAnggota').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggota/FormHapusAnggota.php',
        data        : {id_anggota: id_anggota},
        success     : function(data){
            $('#FormHapusAnggota').html(data);
            $('#NotifikasiHapusAnggota').html('');
        }
    });
});
//Proses Hapus Anggota
$('#ProsesHapusAnggota').submit(function(){
    $('#NotifikasiHapusAnggota').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusAnggota')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Anggota/ProsesHapusAnggota.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusAnggota').html(data);
            var NotifikasiHapusAnggotaBerhasil=$('#NotifikasiHapusAnggotaBerhasil').html();
            if(NotifikasiHapusAnggotaBerhasil=="Success"){
                $('#NotifikasiHapusAnggota').html('');
                $('#ModalHapusAnggota').modal('hide');
                Swal.fire(
                    'Success!',
                    'Hapus Customer Service Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});