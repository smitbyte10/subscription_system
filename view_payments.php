<?php

session_start();
include("config.php");

if(!isset($_SESSION['admin']))
{
header("Location: admin_login.php");
exit();
}

$result=mysqli_query($conn,

"SELECT payments.*,
users.name

FROM payments

JOIN users

ON payments.user_id=users.id"

);

?>

<!DOCTYPE html>
<html>
<head>

<title>Payments</title>

<style>

body{
font-family:Poppins;
background:#0f172a;
color:white;
padding:30px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
color:black;
}

th{
background:#22c55e;
color:white;
padding:12px;
}

td{
padding:12px;
border-bottom:1px solid #ddd;
}

</style>
</head>

<body>

<h1>💳 Payments</h1>

<table>

<tr>

<th>ID</th>
<th>User</th>
<th>Plan</th>
<th>Amount</th>
<th>Date</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['plan']; ?></td>

<td>₹<?php echo $row['amount']; ?></td>

<td><?php echo $row['payment_date']; ?></td>

</tr>

<?php
}
?>

</table>

</body>
</html>