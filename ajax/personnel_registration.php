<?php

require "../config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';

if (isset($_POST)) {

    $pwd = bin2hex(openssl_random_pseudo_bytes(4.5)); // Generate a random password

    $first_name = $_POST["ad"]; // "ad" means first name in Turkish
    $last_name = $_POST["soyad"]; // "soyad" means last name
    $email = $_POST["email"];
    $password_hash = md5($pwd); // Hash the password using MD5
    $role_id = 3; // Role ID for personnel

    // Insert user data into the "users" table
    $query = $db->prepare("INSERT INTO users (first_name, last_name, email, password_hash, role_id) VALUES (:value1, :value2, :value3, :value4, :value5)");
    $save = $query->execute([
        "value1" => $first_name,
        "value2" => $last_name,
        "value3" => $email,
        "value4" => $password_hash,
        "value5" => $role_id,
    ]);

    // Send an email with the generated password
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.mailtrap.io'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = '6b8de83d600922'; // SMTP username
        $mail->Password = 'a53e4ac8e74f24'; // SMTP password
        $mail->CharSet = 'UTF-8'; // Set character encoding

        $mail->Port = 2525; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('comu_staj@comu.edu.com.tr', 'ÇÖMÜ STAGE AUTOMATION'); // Set from email
        $mail->addAddress($email, $first_name . " " . $last_name); // Add recipient

        // Email content
        $html = file_get_contents("../pages/email/code-mail.html");
        $html = str_replace("{KOD}", $pwd, $html); // Replace placeholder with the password

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = 'Your Temporary Password | ÇÖMÜ'; // Email subject
        $mail->msgHTML($html); // Set the HTML message content

        // Send email
        $mail->send();

        // Redirect after successful registration
        header("Location:../admin/personnel-process.php");

    } catch (Exception $e) {
        echo "Email Error Message: {$mail->ErrorInfo}";
    }
}
?>
