<?php
include 'db.php';

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// GET ID
$id = $_GET['id'];

// FETCH DATA
$result = $conn->query("SELECT * FROM appointments WHERE id=$id");
$data = $result->fetch_assoc();

// 📅 CALCULATE REVISIT DATE (7 DAYS LATER)
$revisit_date = date('Y-m-d', strtotime($data['appointment_date'] . ' +7 days'));

// UPDATE STATUS + REVISIT DATE
$conn->query("UPDATE appointments 
SET status='Approved', revisit_date='$revisit_date' 
WHERE id=$id");

// 📧 SEND EMAIL
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'your_email@gmail.com';   // your Gmail
    $mail->Password = 'your_app_password';      // app password (no spaces)

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('your_email@gmail.com', 'Clinic');
    $mail->addAddress($data['email']);

    $mail->isHTML(true);
    $mail->Subject = 'Appointment Confirmed';

    // ✅ UPDATED EMAIL BODY
    $mail->Body = "
    Hello {$data['name']},<br><br>

    Your appointment is <b style='color:green;'>CONFIRMED</b>.<br><br>

    <b>Date:</b> {$data['appointment_date']}<br>
    <b>Time:</b> {$data['appointment_time']}<br><br>

    <b>Revisit Date:</b> $revisit_date<br><br>

    Please visit the clinic on time.<br><br>

    Thank you,<br>
    Clinic Team
    ";

    $mail->send();

    echo "✅ Approved & Email Sent!";
} catch (Exception $e) {
    echo "⚠️ Approved but email failed.";
}
?>