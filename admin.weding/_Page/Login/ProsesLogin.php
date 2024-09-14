<?php
    session_start();
    include "../../_Config/Connection.php";
    date_default_timezone_set('Asia/Jakarta');
    
    $datetime_update = date('Y-m-d H:i:s');
    $expired_seconds = 60 * 60; // 1 hour
    $datetime_expired = date('Y-m-d H:i:s', strtotime($datetime_update) + $expired_seconds);

    // Function to generate a secure token
    function generateToken($length) {
        return bin2hex(random_bytes($length / 2));
    }

    // Function to validate and sanitize input
    function validateAndSanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Validate email and password
    if (empty($_POST["email"])) {
        echo '<code>Email tidak boleh kosong</code>';
    } elseif (empty($_POST["password"])) {
        echo '<code>Password tidak boleh kosong</code>';
    } else {
        $email = validateAndSanitizeInput($_POST["email"]);
        $password = validateAndSanitizeInput($_POST["password"]);

        // Use prepared statements to prevent SQL injection
        $stmt = $Conn->prepare("SELECT * FROM akses WHERE email = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($Conn->error));
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $DataAkses = $result->fetch_assoc();

        if ($DataAkses) {
            $storedPassword = $DataAkses["password"];
            if (password_verify($password, $storedPassword)) {
                $id_akses = $DataAkses["id_akses"];

                // Create new login token
                $token = generateToken(36);
                $updateStmt = $Conn->prepare("UPDATE akses SET token = ?, datetime_update = ?, datetime_expired = ? WHERE id_akses = ?");
                if ($updateStmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($Conn->error));
                }

                $updateStmt->bind_param("sssi", $token, $datetime_update, $datetime_expired, $id_akses);
                if ($updateStmt->execute()) {
                    echo '<span id="NotifikasiProsesLoginBerhasil">Success</span>';
                    $_SESSION["id_akses"] = $id_akses;
                    $_SESSION["token"] = $token;
                    $_SESSION["NotifikasiSwal"] = "Login Berhasil";
                } else {
                    echo '<code>Terjadi kesalahan pada saat membuat sesi login</code>';
                }
                $updateStmt->close();
            } else {
                echo '<code>Password yang Anda masukkan tidak valid</code>';
            }
        } else {
            echo '<code>Email tidak terdaftar</code>';
        }

        $stmt->close();
    }
?>
