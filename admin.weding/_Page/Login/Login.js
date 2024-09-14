$('#ProsesLogin').submit(function(){
    var ProsesLogin = $('#ProsesLogin').serialize();
    var Loading='<div class="spinner-border text-info" role="status"><span class="visually-hidden">Loading...</span></div>';
    $('#NotifikasiLogin').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Login/ProsesLogin.php',
        data 	    :  ProsesLogin,
        success     : function(data){
            $('#NotifikasiLogin').html(data);
            var NotifikasiProsesLoginBerhasil=$('#NotifikasiProsesLoginBerhasil').html();
            if(NotifikasiProsesLoginBerhasil=="Success"){
                window.location.href = "index.php";
            }
        }
    });
});