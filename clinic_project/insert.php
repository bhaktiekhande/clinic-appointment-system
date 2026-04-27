<?php
include 'db.php';

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Form data
$name  = $_POST['name'];
$age   = $_POST['age'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$date  = $_POST['date'];
$time  = $_POST['time'];

// 🔍 CHECK DUPLICATE SLOT
$check = $conn->query("SELECT * FROM appointments 
WHERE appointment_date='$date' AND appointment_time='$time'");

if ($check->num_rows > 0) {
    echo "❌ This slot is already booked. Please choose another time.";
} else {

    // ✅ INSERT DATA WITH PENDING STATUS
    $conn->query("INSERT INTO appointments 
    (name, age, phone, email, appointment_date, appointment_time, status)
    VALUES ('$name', '$age', '$phone', '$email', '$date', '$time', 'Pending')");

    // 📧 SEND EMAIL
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'ekhandebhakti2002@gmail.com';   // 👉 your Gmail
        $mail->Password = 'gdpbmbbnmszthnqo';      // 👉 app password (no spaces)

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your_email@gmail.com', 'Clinic');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Appointment Request Received';

        // ✅ UPDATED EMAIL BODY
        $mail->Body = "
        Hello $name,<br><br>

        Your appointment request is received.<br>
        <b>Status:</b> Pending Doctor Confirmation<br><br>

        <b>Date:</b> $date <br>
        <b>Time:</b> $time <br><br>

        Doctor will review your request and confirm shortly.<br><br>

        Thank you,<br>
        Clinic Team
        ";

        $mail->send();

        echo "✅ Appointment Saved & Email Sent!";
    } catch (Exception $e) {
        echo "⚠️ Saved but email failed.";
    }
}
?>