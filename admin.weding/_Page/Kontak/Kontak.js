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
function ShowRekapKontak() {
    $.ajax({
        type: 'POST',
        url: '_Page/Kontak/RekapKontak.php',
        success: function(data) {
            var chartData = JSON.parse(data);
            var total = chartData.series.reduce((a, b) => a + b, 0);
            var options = {
                chart: {
                    type: 'donut'
                },
                series: chartData.series,
                labels: chartData.labels,
                colors: ['#00E396', '#FF4560'],
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function () {
                                        return total;
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true
                },
                legend: {
                    position: 'bottom'
                }
            };
            var chart = new ApexCharts(document.querySelector("#RekapKontakBelumDihubungi"), options);
            chart.render();
        }
    });
}
function RekapDistribusiKontak() {
    $.ajax({
        type: 'POST',
        url: '_Page/Kontak/RekapDistribusiKontak.php',
        success: function(data) {
            var chartData = JSON.parse(data);
            var total = chartData.series.reduce((a, b) => a + b, 0);
            var options = {
                chart: {
                    type: 'donut'
                },
                series: chartData.series,
                labels: chartData.labels,
                colors: ['#00E396', '#FF4560'],
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function () {
                                        return total;
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true
                },
                legend: {
                    position: 'bottom'
                }
            };
            var chart = new ApexCharts(document.querySelector("#RekapDistribusiKontak"), options);
            chart.render();
        }
    });
}
function RekapSumberKontak() {
    $.ajax({
        type: 'POST',
        url: '_Page/Kontak/RekapSumberKontak.php',
        success: function(data) {
            var chartData = JSON.parse(data);
            var total = chartData.series.reduce((a, b) => a + b, 0);
            var options = {
                chart: {
                    type: 'donut'
                },
                series: chartData.series,
                labels: chartData.labels,
                colors: ['#00E396', '#FF4560'],
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function () {
                                        return total;
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true
                },
                legend: {
                    position: 'bottom'
                }
            };
            var chart = new ApexCharts(document.querySelector("#RekapSumberKontak"), options);
            chart.render();
        }
    });
}
$(document).ready(function() {
    filterAndLoadTable();
    ShowRekapKontak();
    RekapDistribusiKontak();
    RekapSumberKontak();
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
                ShowRekapKontak();
                RekapDistribusiKontak();
                RekapSumberKontak();
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
                ShowRekapKontak();
                RekapDistribusiKontak();
                RekapSumberKontak();
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
                ShowRekapKontak();
                RekapDistribusiKontak();
                RekapSumberKontak();
            }
        }
    });
});
//Proses Import
$('#ProsesImport').submit(function(){
    $('#NotifikasiProsesImport').html('<tr><td align="center" colspan="7">Loading...</td></tr>');
    var form = $('#ProsesImport')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kontak/ProsesImport.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiProsesImport').html(data);
            $("#ProsesFilter")[0].reset();
            $('#page').val("1");
            filterAndLoadTable();
            ShowRekapKontak();
            RekapDistribusiKontak();
            RekapSumberKontak();
        }
    });
});