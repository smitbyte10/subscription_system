<?php

session_start();
include("config.php");

if(!isset($_SESSION['admin']))
{
header("Location: admin_login.php");
exit();
}

$result=mysqli_query($conn,
"SELECT * FROM users");

?>

<!DOCTYPE html>
<html>
<head>
<title>Users</title>

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
background:#8b5cf6;
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

<h1>👥 Users</h1>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Plan</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['plan']; ?></td>

</tr>

<?php
}
?>

</table>

</body>
</html>