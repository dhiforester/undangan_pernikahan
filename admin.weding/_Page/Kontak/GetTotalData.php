<?php
    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    if (isset($_FILES['file_excel']['name'])) {
        $arr_file = explode('.', $_FILES['file_excel']['name']);
        $extension = end($arr_file);
        $reader = ('csv' == $extension) ? new Csv() : new Xlsx();
        $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $JumlahBaris = count($sheetData) - 1; // Kurangi satu untuk menghindari header
        echo $JumlahBaris; // Output jumlah total data
    }
?>