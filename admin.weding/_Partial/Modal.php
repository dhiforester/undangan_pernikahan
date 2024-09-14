<?php
    include "_Page/Logout/ModalLogout.php";
    // Memeriksa apakah 'Page' ada di GET, jika tidak ada berikan nilai kosong
    $Page = $_GET['Page'] ?? ""; 
    // Mapping dari halaman ke file yang akan di-include
    $pages = [
        "MyProfile" => "_Page/MyProfile/ModalMyProfile.php",
        "Akses" => "_Page/Akses/ModalAkses.php",
        "Kontak" => "_Page/Kontak/ModalKontak.php",
        "SettingGeneral" => "_Page/SettingGeneral/ModalSettingGeneral.php",
        "SettingEmail" => "_Page/SettingService/ModalSettingService.php",
        "Aktivitas" => "_Page/Aktivitas/ModalAktivitas.php",
        "Help" => "_Page/Help/ModalHelp.php",
    ];
    // Cek apakah halaman valid dan file ada
    if (isset($pages[$Page]) && file_exists($pages[$Page])) {
        include $pages[$Page];
    }
?>
