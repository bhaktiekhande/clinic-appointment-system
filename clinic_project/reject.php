<?php
include 'db.php';

$id = $_GET['id'];

$conn->query("UPDATE appointments SET status='Rejected' WHERE id=$id");

echo "Appointment Rejected";
?>