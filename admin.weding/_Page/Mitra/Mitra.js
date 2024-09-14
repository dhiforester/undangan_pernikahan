function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $.ajax({
        type: 'POST',
        url: '_Page/Mitra/TabelMitra.php',
        data: ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelMitra').html(data);
        }
    });
}
$(document).ready(function() {
    filterAndLoadTable();
});
$('#ProsesFilter').submit(function(){
    $('#page').val("1");
    filterAndLoadTable();
    $('#ModalFilter').modal('hide');
});
//Kondisi saat tampilkan password
$('.form-check-input').click(function(){
    if($(this).is(':checked')){
        $('#password').attr('type','text');
    }else{
        $('#password').attr('type','password');
    }
});
//Proses Tambah Mitra
$('#ProsesTambah').submit(function(){
    $('#NotifikasiTambah').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambah')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Mitra/ProsesTambah.php',
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
                    'Tambah Tambah Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Detail Mitra
$('#ModalDetail').on('show.bs.modal', function (e) {
    var id_mitra= $(e.relatedTarget).data('id');
    $('#FormDetail').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Mitra/FormDetail.php',
        data        : {id_mitra: id_mitra},
        success     : function(data){
            $('#FormDetail').html(data);
        }
    });
});
//Modal Edit Anggota
$('#ModalEdit').on('show.bs.modal', function (e) {
    var id_mitra= $(e.relatedTarget).data('id');
    $('#FormEdit').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Mitra/FormEdit.php',
        data        : {id_mitra: id_mitra},
        success     : function(data){
            $('#FormEdit').html(data);
            $('#NotifikasiEdit').html('');
        }
    });
});
//Proses Edit Mitra
$('#ProsesEdit').submit(function(){
    $('#NotifikasiEdit').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEdit')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Mitra/ProsesEdit.php',
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
                    'Edit Mitra Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
                ShowRekapMitra();
                RekapDistribusiMitra();
                RekapSumberMitra();
            }
        }
    });
});
//Modal Hapus
$('#ModalHapus').on('show.bs.modal', function (e) {
    var id_mitra= $(e.relatedTarget).data('id');
    $('#FormHapus').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Mitra/FormHapus.php',
        data        : {id_mitra: id_mitra},
        success     : function(data){
            $('#FormHapus').html(data);
            $('#NotifikasiHapus').html('');
        }
    });
});
//Proses Hapus Mitra
$('#ProsesHapus').submit(function(){
    $('#NotifikasiHapus').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapus')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Mitra/ProsesHapus.php',
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
                    'Hapus Mitra Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});