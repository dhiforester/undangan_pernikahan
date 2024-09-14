function showRiwayatTransaksi() {
    $.ajax({
        type: 'POST',
        url: '_Page/TransaksiAnggota/ListRiwayatTransaksi.php',
        success: function(data) {
            $('#ListRiwayatTransaksi').html(data);
        }
    });
}
//Menampilkan Data Transaksi
$(document).ready(function() {
    showRiwayatTransaksi();
});
//Proses Tambah Transaksi
$('#ProsesTambahTransaksi').submit(function(){
    $('#NotifikasiTambahTransaksi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahTransaksi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/TransaksiAnggota/ProsesTambahTransaksi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahTransaksi').html(data);
            var NotifikasiTambahTransaksiBerhasil=$('#NotifikasiTambahTransaksiBerhasil').html();
            if(NotifikasiTambahTransaksiBerhasil=="Success"){
                window.location.href = "index.php?Page=TransaksiAnggota";
            }
        }
    });
});