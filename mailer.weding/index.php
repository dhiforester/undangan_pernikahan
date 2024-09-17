<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    // Set timezone
    date_default_timezone_set('Asia/Jakarta');
    
    // Include PHPMailer classes
    require 'mail/src/Exception.php';
    require 'mail/src/PHPMailer.php';
    require 'mail/src/SMTP.php';
    
    // Capture POST data
    $fp = fopen('php://input', 'r');
    $raw = stream_get_contents($fp);
    $Tangkap = json_decode($raw, true);
    
    $response = [];
    
    if (empty($Tangkap['subjek'])) {
        $response = [
            "code" => "201",
            "pesan" => "Subjek Tidak Boleh Kosong",
        ];
    } else if (empty($Tangkap['email_asal'])) {
        $response = [
            "code" => "201",
            "pesan" => "Email Asal Tidak Boleh Kosong",
        ];
    } else if (empty($Tangkap['password_email_asal'])) {
        $response = [
            "code" => "201",
            "pesan" => "Password Email Asal Tidak Boleh Kosong",
        ];
    } else if (empty($Tangkap['url_provider'])) {
        $response = [
            "code" => "201",
            "pesan" => "URL Provider Tidak Boleh Kosong",
        ];
    } else if (empty($Tangkap['nama_pengirim'])) {
        $response = [
            "code" => "201",
            "pesan" => "Nama Pengirim Tidak Boleh Kosong",
        ];
    } else if (empty($Tangkap['email_tujuan'])) {
        $response = [
            "code" => "201",
            "pesan" => "Email Tujuan Tidak Boleh Kosong",
        ];
    } else if (empty($Tangkap['nama_tujuan'])) {
        $response = [
            "code" => "201",
            "pesan" => "Nama Tujuan Tidak Boleh Kosong",
        ];
    } else if (empty($Tangkap['port'])) {
        $response = [
            "code" => "201",
            "pesan" => "Port SMTP Tidak Boleh Kosong",
        ];
    } else if (empty($Tangkap['pesan'])) {
        $response = [
            "code" => "201",
            "pesan" => "Isi Pesan Tidak Boleh Kosong",
        ];
    } else {
        // Initialize PHPMailer
        $mail = new PHPMailer(true);
        try {
            // SMTP server configuration
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $Tangkap['url_provider'];               // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $Tangkap['email_asal'];                 // SMTP username
            $mail->Password   = $Tangkap['password_email_asal'];        // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
            $mail->Port       = $Tangkap['port'];                       // TCP port to connect to
    
            // Recipients
            $mail->setFrom($Tangkap['email_asal'], $Tangkap['nama_pengirim']);
            $mail->addAddress($Tangkap['email_tujuan'], $Tangkap['nama_tujuan']);
    
            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = $Tangkap['subjek'];
            $mail->Body    = $Tangkap['pesan'];
            $mail->AltBody = strip_tags($Tangkap['pesan']);
    
            // Send email
            if ($mail->send()) {
                $response = [
                    "code" => "200",
                    "pesan" => "Email Terkirim",
                    "detail" => [
                        "from" => $Tangkap['email_asal'],
                        "to" => $Tangkap['email_tujuan'],
                        "subject" => $Tangkap['subjek'],
                    ],
                ];
            } else {
                $response = [
                    "code" => "201",
                    "pesan" => "Email Tidak Terkirim",
                ];
            }
        } catch (Exception $e) {
            $response = [
                "code" => "201",
                "pesan" => "Error: " . $e->getMessage(),
            ];
        }
    }
    
    // Encode response as JSON
    $json = json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    
    // Set headers
    header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + (10 * 60)));
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header('Content-Type: application/json');
    header('Pragma: no-cache');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, x-token, token");
    
    // Output JSON response
    echo $json;
?>