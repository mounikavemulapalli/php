<?php

require "../config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';

if (isset($_POST)) {

    // Generate a random password
    $pwd = bin2hex(openssl_random_pseudo_bytes(4.5));

    // Collect form data
    $firstName = $_POST["ad"];
    $lastName = $_POST["soyad"];
    $password = md5($pwd); // MD5 is not secure; consider using password_hash() for better security
    $studentNo = $_POST["no"];

    $department = $_POST["bolum"];
    $advisorId = $_POST["danisman_id"];

    // Construct email address using student number
    $email = $studentNo . "@ogr.comu.edu.tr";

    $roleId = 4; // Student role

    // Insert the user's basic details into the database
    $query = $db->prepare("INSERT INTO users (first_name, last_name, email, password_hash, role_id) VALUES (:value1, :value2, :value3, :value4, :value5)");
    $save = $query->execute([
        "value1" => $firstName,
        "value2" => $lastName,
        "value3" => $email,
        "value4" => $password,
        "value5" => $roleId,
    ]);

    if ($save) {
        $id = $db->lastInsertId();

        // Insert additional student details into the student details table
        $query = $db->prepare("INSERT INTO student_details (student_id, student_no, advisor_id_fk, department_id_fk) VALUES (:value1, :value2, :value3, :value4)");
        $query->execute([
            "value1" => $id,
            "value2" => $studentNo,
            "value3" => $advisorId,
            "value4" => $department,
        ]);
    }

    // Create a new PHPMailer instance for sending email
    $mail = new PHPMailer(true);

    try {
        // Server settings for sending the email
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.mailtrap.io'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = '6b8de83d600922'; // SMTP username
        $mail->Password = 'a53e4ac8e74f24'; // SMTP password
        $mail->CharSet = 'UTF-8'; // Character encoding for the email
        $mail->Port = 2525; // TCP port to connect to (you can use 587 for TLS)

        // Recipients
        $mail->setFrom('comu_staj@comu.edu.com.tr', 'ÇÖMÜ Internship Automation');
        $mail->addAddress($email, $firstName . " " . $lastName);

        // Load the email HTML template and replace placeholder with the generated password
        $html = file_get_contents("../pages/email/code-mail.html");
        $html = str_replace("{KOD}", $pwd, $html);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your Temporary Password | ÇÖMÜ';
        $mail->msgHTML($html);

        // Send the email
        $mail->send();

        // Redirect after successful email sending
        header("Location:../personnel/student-management.php");

    } catch (Exception $e) {
        // Handle email sending errors
        echo "Email Error Message: {$mail->ErrorInfo}";
    }
}
?>
