// default example
simplyCountdown('.simply-countdown-one', {
    year: 2024,
    month: 9,
    day: 29,
    hours: 0,
    minutes: 0,
    seconds: 0
});
// document.addEventListener('DOMContentLoaded', function() {
//     let header = document.querySelector('#fh5co-header .snowflakes');
//     let numFlakes = 100;
//     for (let i = 0; i < numFlakes; i++) {
//         let flake = document.createElement('div');
//         flake.className = 'snowflake';
//         flake.style.left = Math.random() * 100 + 'vw';
//         flake.style.animationDuration = (Math.random() * 10) + 5 + 's';
//         flake.style.animationDelay = Math.random() * 5 + 's';
//         header.appendChild(flake);
//     }
// });
$(document).ready(function() {
    let $verses = $(".quran-verse");
    let index = 0;
    // Mencari ketinggian maksimum dari semua elemen quran-verse
    let maxHeight = 0;
    $verses.each(function() {
        let height = $(this).outerHeight();
        if (height > maxHeight) {
            maxHeight = height;
        }
    });
    // Mengatur ketinggian kontainer sesuai dengan elemen yang paling tinggi
    $(".quran-quote").css("min-height", maxHeight);
    function showNextVerse() {
        $verses.eq(index).fadeOut(1000, function() {
            // Callback setelah elemen menghilang
            index = (index + 1) % $verses.length; // Mengatur indeks ke elemen berikutnya
            $verses.eq(index).fadeIn(1000); // Menampilkan elemen berikutnya dengan efek fade
        });
        setTimeout(showNextVerse, 5000); // Menampilkan elemen berikutnya setelah 5 detik
    }
    $verses.eq(index).fadeIn(1000); // Menampilkan elemen pertama dengan efek fade
    setTimeout(showNextVerse, 5000); // Memulai animasi setelah 5 detik
    $("#ProsesKonfirmasiKehadiran").submit(function(event) {
        event.preventDefault(); // Mencegah form submit default
        let $button = $("#TombolKonfirmasi");
        $button.text('Loading...'); // Ubah teks tombol menjadi "Loading..."

        // Mengirimkan data form menggunakan AJAX
        $.ajax({
            url: '_Config/ProsesKonfirmasi.php', // URL untuk mengirim data
            type: 'POST',
            data: $(this).serialize(), // Mengambil semua data form
            dataType: 'json', // Mengharapkan response JSON
            success: function(response) {
                if (response.success) {
                    $('#ProsesKonfirmasiKehadiran')[0].reset(); // Reset form
                    $('#modalBerhasil').modal('show'); // Tampilkan modal sukses
                } else {
                    // Tampilkan modal gagal dengan pesan error
                    $('#NotifikasiProsesGagal').text(response.message);
                    $('#modalGagal').modal('show');
                }
            },
            error: function(xhr, status, error) {
                // Debugging: Tampilkan error response di console
                console.log("Error Status: ", status);
                console.log("Error Thrown: ", error);
                console.log("Response Text: ", xhr.responseText);
                alert('Terjadi kesalahan, silakan coba lagi.');
            },
            complete: function() {
                $button.text('Konfirmasi'); // Kembalikan teks tombol menjadi "Konfirmasi"
            }
        });
    });
    // Tampilkan modal ketika halaman dimuat
    $('#welcomeModal').modal('show');
    // Event listener untuk tombol mulai musik
    $('#startMusicButton').click(function() {
        var audio = document.getElementById('backgroundMusic');
        audio.play().catch(function(error) {
            console.log('Error playing audio:', error);
        });
        $('#welcomeModal').modal('hide');
    });
    // Mengatur gaya untuk #welcomeModal .modal-dialog
    $('#welcomeModal .modal-dialog').css({
        'width': '100%',
        'height': '100%',
        'margin': '0',
        'padding': '0',
        'max-width': '100%'
    });

    // Mengatur gaya untuk #welcomeModal .modal-content
    $('#welcomeModal .modal-content').css({
        'height': '100%',
        'border-radius': '0',
        'background-size': 'cover',
        'background-position': 'center',
        'background-repeat': 'no-repeat',
        'color': '#fff',
        'position': 'relative',
        'overflow': 'hidden'
    });

    // Menambahkan elemen overlay gelap
    $('<div></div>').css({
        'position': 'absolute',
        'top': '0',
        'left': '0',
        'width': '100%',
        'height': '100%',
        'background': 'rgba(0, 0, 0, 0.5)',
        'z-index': '1'
    }).prependTo('#welcomeModal .modal-content');

    // Mengatur gaya untuk #welcomeModal .modal-body
    $('#welcomeModal .modal-body').css({
        'position': 'relative',
        'z-index': '2',
        'height': '100%',
        'display': 'flex',
        'align-items': 'center',
        'justify-content': 'center',
        'flex-direction': 'column'
    });

    // Mengatur gaya untuk teks
    $('#welcomeModal h1, #welcomeModal span, #welcomeModal small').css({
        'color': '#fff'
    });

    // Mengatur gaya untuk tombol
    $('#startMusicButton').css({
        'padding': '10px 20px',
        'font-size': '1.2em'
    });
});
$('#ProsesKirimUcapan').submit(function(e){
    e.preventDefault();

    var nama = $('#nama_pengirim').val();
    var pesan = $('#pesan').val();

    // Validasi Nama
    var namaValid = /^[A-Za-z\s]+$/.test(nama) && nama.length <= 50;
    if (!namaValid) {
        $('#NotifikasiKirimPesanGagal').text('Nama hanya boleh huruf dan spasi, serta tidak boleh lebih dari 50 karakter.');
        $('#ModalKirimPesanGagal').modal('show');
        return false;
    }

    // Validasi Pesan
    if (pesan.length > 500) {
        $('#NotifikasiKirimPesanGagal').text('Pesan tidak boleh lebih dari 100 karakter.');
        $('#ModalKirimPesanGagal').modal('show');
        return false;
    }

    $('#TombolKirimUcapan').text('Loading...').attr('disabled', true);

    $.ajax({
        url: '_Config/ProsesKirimPesan.php',
        type: 'POST',
        data: {
            nama: nama,
            pesan: pesan
        },
        success: function(response) {
            if (response.success) {
                $('#ModalKirimPesanBerhasil').modal('show');
                $('#ProsesKirimUcapan')[0].reset();
            } else {
                $('#NotifikasiKirimPesanGagal').text(response.message);
                $('#ModalKirimPesanGagal').modal('show');
            }
            $('#TombolKirimUcapan').text('Kirim').attr('disabled', false);
        },
        error: function(xhr, status, error) {
            $('#NotifikasiKirimPesanGagal').text('Terjadi kesalahan pada server.');
            $('#ModalKirimPesanGagal').modal('show');
            $('#TombolKirimUcapan').text('Kirim').attr('disabled', false);
        }
    });
});
//Untuk Pesan Masuk (Testimonial)

