<?php

require "../config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';

if (isset($_POST)){

    $pwd = bin2hex(openssl_random_pseudo_bytes(4.5));

    $first_name = $_POST["ad"];
    $last_name = $_POST["soyad"];
    $password = md5($pwd);
    $student_no = $_POST["no"];

    $department = $_POST["bolum"];
    $advisor_id = $_POST["danisman_id"];

    // student_no@ogr.comu.edu.tr
    $email = $student_no."@ogr.comu.edu.tr";

    $role_id = 4;

    $query = $db->prepare("INSERT INTO users (first_name, last_name, email, password_hash, role_id) VALUES (:value1, :value2, :value3, :value4, :value5)");
    $save = $query->execute([
        "value1" => $first_name,
        "value2" => $last_name,
        "value3" => $email,
        "value4" => $password,
        "value5" => $role_id,
    ]);

    if ($save){
        $id = $db->lastInsertId();

        $query = $db->prepare("INSERT INTO student_details (student_id, student_no, advisor_id_fk, department_id_fk) VALUES (:value1, :value2, :value3, :value4)");
        $query->execute([
            "value1" => $id,
            "value2" => $student_no,
            "value3" => $advisor_id,
            "value4" => $department,
        ]);
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.mailtrap.io';                      // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
        $mail->Username   = '6b8de83d600922';                        // SMTP username
        $mail->Password   = 'a53e4ac8e74f24';                        // SMTP password
        $mail->CharSet = 'UTF-8';
        $mail->Port       = 2525;                                     // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('comu_staj@comu.edu.com.tr', 'ÇÖMÜ STAJ AUTOMATION');
        $mail->addAddress($email, $first_name." ".$last_name);

        $html = file_get_contents("../pages/email/code-mail.html");
        $html = str_replace("{KOD}", $pwd, $html);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Temporary Password | ÇÖMÜ';
        $mail->msgHTML($html);

        $mail->send();

        header("Location:../admin/student-operation.php");

    } catch (Exception $e) {
        echo "Email Error Message: {$mail->ErrorInfo}";
    }

}
