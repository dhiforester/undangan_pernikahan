//Ketika Pertama Kali Tangkap urlencode dan ubah menjadi text
var urlencode = $('#urlencode').val();
var decodedPesan = decodeURIComponent(urlencode);
$('#script_pesan').val(decodedPesan);
//Kondisi Ketika Mengetik Pesan 
$('#script_pesan').on('input', function() {
    // Ambil nilai dari textarea
    var pesan = $(this).val();
    // Ubah teks menjadi URL-encoded
    var encodedPesan = encodeURIComponent(pesan);
    // Tampilkan hasil URL-encoded ke textarea dengan id "urlencode"
    $('#urlencode').val(encodedPesan);
});
//Proses Simpan Pengaturan
$('#ProsesSettingGeneral').submit(function(){
    $('#NotifikasiSimpanSettingGeneral').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesSettingGeneral')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingGeneral/ProsesSettingGeneral.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiSimpanSettingGeneral').html(data);
            var NotifikasiSimpanSettingGeneralBerhasil=$('#NotifikasiSimpanSettingGeneralBerhasil').html();
            if(NotifikasiSimpanSettingGeneralBerhasil=="Success"){
                window.location.href = "index.php?Page=SettingGeneral";
            }
        }
    });
});
//Proses Simpan Script Wa
$('#ProsesSettingScript').submit(function(){
    $('#NotifikasiSettingScript').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesSettingScript')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingGeneral/ProsesSettingScript.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiSettingScript').html(data);
            var NotifikasiSettingScriptBerhasil=$('#NotifikasiSettingScriptBerhasil').html();
            if(NotifikasiSettingScriptBerhasil=="Success"){
                window.location.href = "index.php?Page=SettingGeneral";
            }
        }
    });
});