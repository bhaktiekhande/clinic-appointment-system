<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>📅 Book Appointment</h2>

<form action="insert.php" method="POST">

<input type="text" name="name" placeholder="Enter Your Name" required>

<input type="number" name="age" placeholder="Enter Age" required>

<input type="text" name="phone" placeholder="Enter Phone Number" required>

<input type="email" name="email" placeholder="Enter Email Address" required>

<label>Appointment Date</label>
<input type="date" name="date" required>

<label>Select Time</label>
<select name="time" required>
    <option value="">Select Time</option>
    <option value="10:00:00">10:00 AM</option>
    <option value="11:00:00">11:00 AM</option>
    <option value="12:00:00">12:00 PM</option>
    <option value="14:00:00">02:00 PM</option>
    <option value="15:00:00">03:00 PM</option>
</select>

<br><br>

<button type="submit">Book Appointment</button>

</form>

<br>

<a href="index.php">⬅ Back to Home</a>

</div>

</body>
</html>