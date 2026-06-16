<?php

session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id=$_SESSION['user_id'];

$result=mysqli_query($conn,

"SELECT * FROM activity_log
WHERE user_id='$user_id'
ORDER BY activity_time DESC"

);

?>

<!DOCTYPE html>
<html>
<head>

<title>Activity History</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#0f172a;
color:white;
min-height:100vh;
padding:40px;
}

.header{
text-align:center;
margin-bottom:40px;
}

.header h1{
font-size:45px;
}

.timeline{
max-width:800px;
margin:auto;
position:relative;
}

.timeline::before{
content:'';
position:absolute;
left:30px;
top:0;
width:4px;
height:100%;
background:#8b5cf6;
}

.event{
position:relative;
background:#1e293b;
padding:20px;
margin-bottom:25px;
margin-left:70px;
border-radius:15px;
box-shadow:0 8px 20px rgba(0,0,0,.3);
}

.event::before{
content:'';
position:absolute;
width:18px;
height:18px;
background:#8b5cf6;
border-radius:50%;
left:-49px;
top:25px;
}

.activity{
font-size:18px;
font-weight:bold;
margin-bottom:8px;
}

.time{
color:#cbd5e1;
font-size:14px;
}

.back{
display:inline-block;
margin-bottom:30px;
padding:10px 20px;
background:#8b5cf6;
color:white;
text-decoration:none;
border-radius:10px;
}

.back:hover{
background:#7c3aed;
}

</style>

</head>

<body>

<a href="dashboard.php" class="back">
← Dashboard
</a>

<div class="header">

<h1>
📊 Activity Timeline
</h1>

</div>

<div class="timeline">

<?php

while($row=mysqli_fetch_assoc($result))
{
?>

<div class="event">

<div class="activity">
<?php echo $row['activity']; ?>
</div>

<div class="time">
<?php echo $row['activity_time']; ?>
</div>

</div>

<?php
}
?>

</div>

</body>
</html>