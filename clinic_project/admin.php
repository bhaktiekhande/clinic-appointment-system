<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
include 'db.php';

$result = $conn->query("SELECT * FROM appointments");
?>

<h2>Doctor Panel</h2>

<table border="1" cellpadding="10">
<tr>
<th>Name</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>
<td><?php echo $row['appointment_time']; ?></td>
<td><?php echo $row['status']; ?></td>
<td>
<a href="approve.php?id=<?php echo $row['id']; ?>">Approve</a> |
<a href="reject.php?id=<?php echo $row['id']; ?>">Reject</a>
</td>
</tr>
<?php } ?>

</table>