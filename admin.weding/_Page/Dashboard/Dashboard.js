$(document).ready(function () {
    // Fungsi untuk mengambil data dari file JSON
    $.getJSON("_Page/Dashboard/GrafikAktivitas.json", function (data) {
        // Mengolah data untuk ApexCharts
        const categories = data.map(item => item.x);
        const LogAktivitas = data.map(item => parseFloat(item.yLog));
        const LogHalaman = data.map(item => parseFloat(item.yLogHalaman));
        // Konfigurasi grafik
        var options = {
            chart: {
                type: 'bar',
                height: 400
            },
            series: [
                {
                    name: 'Log Aktivitas',
                    data: LogAktivitas
                },
                {
                    name: 'Log Halaman',
                    data: LogHalaman
                }
            ],
            xaxis: {
                categories: categories
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value;
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (value) {
                        return value;
                    }
                }
            }
        };

        // Inisialisasi grafik
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    });
});