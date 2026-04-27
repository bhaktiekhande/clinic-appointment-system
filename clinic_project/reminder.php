<?php
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

// GET TODAY DATE
$today = date('Y-m-d');

// FIND PATIENTS WITH TODAY REVISIT
$result = $conn->query("SELECT * FROM appointments 
WHERE revisit_date='$today' AND status='Approved'");

while ($row = $result->fetch_assoc()) {

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@gmail.com';
    $mail->Password = 'your_app_password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('your_email@gmail.com', 'Clinic');
    $mail->addAddress($row['email']);

    $mail->isHTML(true);
    $mail->Subject = 'Revisit Reminder';

    $mail->Body = "
    Hello {$row['name']},<br><br>

    This is a reminder for your revisit appointment today.<br><br>

    Please visit the clinic.<br><br>

    Thank you.
    ";

    $mail->send();
}

echo "Reminder process completed";
?>