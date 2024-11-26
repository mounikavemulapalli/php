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
    $email = $_POST["email"];
    $password = md5($pwd);
    $role_id = 2;

    $query = $db->prepare("INSERT INTO users (first_name, last_name, email, passwordHash, role_id) VALUES (:value1, :value2, :value3, :value4, :value5)");
    $save = $query->execute([
        "value1" => $first_name,
        "value2" => $last_name,
        "value3" => $email,
        "value4" => $password,
        "value5" => $role_id,
    ]);

    $department = $_POST["bolum"];
    $title = $_POST["unvan"];

    if ($save){
        $id = $db->lastInsertId();

        $query = $db->prepare("INSERT INTO advisor_details (title_id, advisor_id, department_id) VALUES (:value1, :value2, :value3)");
        $query->execute([
            "value1" => $title,
            "value2" => $id,
            "value3" => $department,
        ]);
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.mailtrap.io';                      //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
        $mail->Username   = '6b8de83d600922';                        //SMTP username
        $mail->Password   = 'a53e4ac8e74f24';                        //SMTP password
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           //Enable implicit TLS encryption
        $mail->Port       = 2525;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('comu_staj@comu.edu.com.tr', 'ÇÖMÜ STAJ AUTOMATION');
        $mail->addAddress($email, $first_name." ".$last_name);

        $html = file_get_contents("../pages/email/code-email.html");
        $html = str_replace("{KOD}", $pwd, $html);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Temporary Password | ÇÖMÜ';
        $mail->msgHTML($html);

        $mail->send();

        header("Location:../admin/advisor-operation.php");

    } catch (Exception $e) {
        echo "Email Error Message: {$mail->ErrorInfo}";
    }

}
