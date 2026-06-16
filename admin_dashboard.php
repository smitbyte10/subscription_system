<?php

session_start();
include("config.php");

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

$total_users=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) as total FROM users")
);

$free_users=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) as total FROM users WHERE plan='Free'")
);

$basic_users=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) as total FROM users WHERE plan='Basic'")
);

$premium_users=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) as total FROM users WHERE plan='Premium'")
);

$revenue=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT SUM(amount) as total FROM payments")
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

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
}

.sidebar{
position:fixed;
width:250px;
height:100%;
background:#111827;
padding-top:30px;
}

.logo{
text-align:center;
font-size:30px;
font-weight:bold;
margin-bottom:40px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
padding:15px 25px;
transition:.3s;
}

.sidebar a:hover{
background:#1e293b;
}

.main{
margin-left:250px;
padding:30px;
}

.title{
font-size:40px;
margin-bottom:25px;
}

.cards{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.card{
padding:25px;
border-radius:20px;
box-shadow:0 8px 20px rgba(0,0,0,.3);
}

.total{
background:linear-gradient(135deg,#3b82f6,#2563eb);
}

.free{
background:linear-gradient(135deg,#22c55e,#16a34a);
}

.basic{
background:linear-gradient(135deg,#f59e0b,#d97706);
}

.premium{
background:linear-gradient(135deg,#8b5cf6,#7c3aed);
}

.revenue{
background:linear-gradient(135deg,#ec4899,#db2777);
}

.card h3{
margin-bottom:10px;
}

.card h1{
font-size:40px;
}

.quick{
margin-top:40px;
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.quick a{
text-decoration:none;
color:white;
}

.quick-card{
background:#1e293b;
padding:25px;
border-radius:20px;
text-align:center;
transition:.3s;
}

.quick-card:hover{
transform:translateY(-5px);
}

.icon{
font-size:50px;
margin-bottom:10px;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">
👑 Admin
</div>

<a href="admin_dashboard.php">
🏠 Dashboard
</a>

<a href="view_users.php">
👥 Users
</a>

<a href="view_payments.php">
💳 Payments
</a>

<a href="view_activity.php">
📊 Activity
</a>

<a href="admin_logout.php">
🚪 Logout
</a>

</div>

<div class="main">

<div class="title">
Admin Dashboard
</div>

<div class="cards">

<div class="card total">
<h3>Total Users</h3>
<h1><?php echo $total_users['total']; ?></h1>
</div>

<div class="card free">
<h3>Free Users</h3>
<h1><?php echo $free_users['total']; ?></h1>
</div>

<div class="card basic">
<h3>Basic Users</h3>
<h1><?php echo $basic_users['total']; ?></h1>
</div>

<div class="card premium">
<h3>Premium Users</h3>
<h1><?php echo $premium_users['total']; ?></h1>
</div>

<div class="card revenue">
<h3>Total Revenue</h3>
<h1>₹<?php echo $revenue['total'] ?? 0; ?></h1>
</div>

</div>

<div class="quick">

<a href="view_users.php">
<div class="quick-card">
<div class="icon">👥</div>
<h2>View Users</h2>
</div>
</a>

<a href="view_payments.php">
<div class="quick-card">
<div class="icon">💳</div>
<h2>View Payments</h2>
</div>
</a>

<a href="view_activity.php">
<div class="quick-card">
<div class="icon">📊</div>
<h2>Activity Logs</h2>
</div>
</a>

</div>

</div>

</body>
</html>