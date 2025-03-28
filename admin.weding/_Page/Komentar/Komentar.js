function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $.ajax({
        type: 'POST',
        url: '_Page/Komentar/TabelKomentar.php',
        data: ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelKomentar').html(data);
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
        url 	    : '_Page/Komentar/FormFilter.php',
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
//Detail
$('#ModalDetail').on('show.bs.modal', function (e) {
    var id= $(e.relatedTarget).data('id');
    $('#FormDetail').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Komentar/FormDetail.php',
        data        : {id: id},
        success     : function(data){
            $('#FormDetail').html(data);
        }
    });
});
//Modal Edit Anggota
$('#ModalEdit').on('show.bs.modal', function (e) {
    var id_komentar= $(e.relatedTarget).data('id');
    $('#FormEdit').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Komentar/FormEdit.php',
        data        : {id_komentar: id_komentar},
        success     : function(data){
            $('#FormEdit').html(data);
            $('#NotifikasiEdit').html('');
        }
    });
});
//Proses Edit Komentar
$('#ProsesEdit').submit(function(){
    $('#NotifikasiEdit').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEdit')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Komentar/ProsesEdit.php',
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
                    'Edit Komentar Berhasil!',
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
    var id_komentar= $(e.relatedTarget).data('id');
    $('#FormHapus').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Komentar/FormHapus.php',
        data        : {id_komentar: id_komentar},
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
        url 	    : '_Page/Komentar/ProsesHapus.php',
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
                    'Hapus Komentar Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Hapus Multi Muncul
$('#ModalHapusMulti').on('show.bs.modal', function (e) {
    var ProsesTabelKomentar=$('#ProsesTabelKomentar').serialize();
    $('#FormHapusMulti').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Komentar/FormHapusMulti.php',
        data        : ProsesTabelKomentar,
        success     : function(data){
            $('#FormHapusMulti').html(data);
        }
    });
});
//Proses Hapus Komentar Mutli
$('#KonfirmasiHapusKomentarMulti').click(function(){
    $('#NotifikasiHapusMulti').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTabelKomentar')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Komentar/ProsesHapusMulti.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusMulti').html(data);
            var NotifikasiHapusMultiBerhasil=$('#NotifikasiHapusMultiBerhasil').html();
            if(NotifikasiHapusMultiBerhasil=="Success"){
                $('#NotifikasiHapusMulti').html('');
                $('#ModalHapusMulti').modal('hide');
                Swal.fire(
                    'Success!',
                    'Hapus Komentar Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});