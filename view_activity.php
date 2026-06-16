<?php

session_start();
include("config.php");

if(!isset($_SESSION['admin']))
{
header("Location: admin_login.php");
exit();
}

$result=mysqli_query($conn,

"SELECT activity_log.*,
users.name

FROM activity_log

JOIN users

ON activity_log.user_id=users.id

ORDER BY activity_time DESC"

);

?>

<!DOCTYPE html>
<html>
<head>

<title>Activity Logs</title>

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
background:#f59e0b;
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

<h1>📊 Activity Logs</h1>

<table>

<tr>

<th>User</th>
<th>Activity</th>
<th>Date</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['activity']; ?></td>

<td><?php echo $row['activity_time']; ?></td>

</tr>

<?php
}
?>

</table>

</body>
</html>