function filterAndLoadTable() {
    var ProsesFilter = $('#ProsesFilter').serialize();
    $.ajax({
        type: 'POST',
        url: '_Page/Transaksi/TabelTransaksi.php',
        data: ProsesFilter,
        success: function(data) {
            $('#MenampilkanTabelTransaksi').html(data);
        }
    });
}
//Semua class nominal hanya angka
$('.nominal_angka').on('keypress', function(e) {
    // Hanya mengizinkan angka (0-9)
    if (e.which < 48 || e.which > 57) {
        e.preventDefault();
    }
});
//Menampilkan Data Transaksi
$(document).ready(function() {
    filterAndLoadTable();
});
$('#keyword_by').change(function(){
    var keyword_by = $('#keyword_by').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormFilter.php',
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
$('#FormFilterJenisTransaksi').submit(function(){
    $('#PutPageJenisTransaksi').val("1");
    filterJenisTransaksi();
});

//Proses Tambah Transaksi
$('#ProsesTambahTransaksi').submit(function(){
    $('#NotifikasiTambahTransaksi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahTransaksi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/ProsesTambahTransaksi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahTransaksi').html(data);
            var NotifikasiTambahTransaksiBerhasil=$('#NotifikasiTambahTransaksiBerhasil').html();
            if(NotifikasiTambahTransaksiBerhasil=="Success"){
                window.location.href = "index.php?Page=Transaksi";
            }
        }
    });
});
//Detail Jenis Transaksi
$('#ModalDetail').on('show.bs.modal', function (e) {
    var id_transaksi= $(e.relatedTarget).data('id');
    $('#FormDetail').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormDetail.php',
        data        : {id_transaksi: id_transaksi},
        success     : function(data){
            $('#FormDetail').html(data);
        }
    });
});
//Proses Edit Transaksi
$('#ProsesEditTransaksi').submit(function(){
    $('#NotifikasiEditTransaksi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditTransaksi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/ProsesEditTransaksi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditTransaksi').html(data);
            var NotifikasiEditTransaksiBerhasil=$('#NotifikasiEditTransaksiBerhasil').html();
            if(NotifikasiEditTransaksiBerhasil=="Success"){
                window.location.href = "index.php?Page=Transaksi";
            }
        }
    });
});
//Modal Hapus Anggota
$('#ModalHapus').on('show.bs.modal', function (e) {
    var id_transaksi= $(e.relatedTarget).data('id');
    $('#FormHapus').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormHapus.php',
        data        : {id_transaksi: id_transaksi},
        success     : function(data){
            $('#FormHapus').html(data);
            $('#NotifikasiHapus').html('');
        }
    });
});
//Proses Hapus Jenis Transaksi
$('#ProsesHapus').submit(function(){
    $('#NotifikasiHapus').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapus')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/ProsesHapus.php',
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
                    'Hapus Transaksi Berhasil!',
                    'success'
                )
                //Menampilkan Data
                filterAndLoadTable();
            }
        }
    });
});
//Modal Tambah Jurnal
$('#ModalTambahJurnal').on('show.bs.modal', function (e) {
    var id_transaksi= $(e.relatedTarget).data('id');
    $('#FormTambahJurnal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormTambahJurnal.php',
        data        : {id_transaksi: id_transaksi},
        success     : function(data){
            $('#FormTambahJurnal').html(data);
            $('#NotifikasiTambahJurnal').html('');
        }
    });
});
//Proses Tambah Jurnal
$('#ProsesTambahJurnal').submit(function(){
    $('#NotifikasiTambahJurnal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahJurnal')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/ProsesTambahJurnal.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahJurnal').html(data);
            var NotifikasiTambahJurnalBerhasil=$('#NotifikasiTambahJurnalBerhasil').html();
            if(NotifikasiTambahJurnalBerhasil=="Success"){
                $('#NotifikasiTambahJurnal').html('');
                $('#ModalTambahJurnal').modal('hide');
                Swal.fire(
                    'Success!',
                    'Tambah Jurnal Berhasil!',
                    'success'
                )
                //Menampilkan Data
                jurnalTransaksi();
            }
        }
    });
});
//Modal Edit Jurnal
$('#ModalEditJurnal').on('show.bs.modal', function (e) {
    var id_jurnal= $(e.relatedTarget).data('id');
    $('#FormEditJurnal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormEditJurnal.php',
        data        : {id_jurnal: id_jurnal},
        success     : function(data){
            $('#FormEditJurnal').html(data);
            $('#NotifikasiEditJurnal').html('');
        }
    });
});
//Proses Edit Jurnal
$('#ProsesEditJurnal').submit(function(){
    $('#NotifikasiEditJurnal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditJurnal')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/ProsesEditJurnal.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditJurnal').html(data);
            var NotifikasiEditJurnalBerhasil=$('#NotifikasiEditJurnalBerhasil').html();
            if(NotifikasiEditJurnalBerhasil=="Success"){
                $('#NotifikasiEditJurnal').html('');
                $('#ModalEditJurnal').modal('hide');
                Swal.fire(
                    'Success!',
                    'Edit Jurnal Berhasil!',
                    'success'
                )
                //Menampilkan Data
                jurnalTransaksi();
            }
        }
    });
});
//Modal Hapus Jurnal
$('#ModalHapusJurnal').on('show.bs.modal', function (e) {
    var id_jurnal= $(e.relatedTarget).data('id');
    $('#FormHapusJurnal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/FormHapusJurnal.php',
        data        : {id_jurnal: id_jurnal},
        success     : function(data){
            $('#FormHapusJurnal').html(data);
            $('#NotifikasiHapusJurnal').html('');
        }
    });
});
//Proses Hapus Jurnal
$('#ProsesHapusJurnal').submit(function(){
    $('#NotifikasiHapusJurnal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusJurnal')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Transaksi/ProsesHapusJurnal.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusJurnal').html(data);
            var NotifikasiHapusJurnalBerhasil=$('#NotifikasiHapusJurnalBerhasil').html();
            if(NotifikasiHapusJurnalBerhasil=="Success"){
                $('#NotifikasiHapusJurnal').html('');
                $('#ModalHapusJurnal').modal('hide');
                Swal.fire(
                    'Success!',
                    'HHapus Jurnal Berhasil!',
                    'success'
                )
                //Menampilkan Data
                jurnalTransaksi();
            }
        }
    });
});