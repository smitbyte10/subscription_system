<?php

session_start();

if(!isset($_SESSION['user_id']))
{
header("Location: login.php");
exit();
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

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
left:0;
top:0;
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

.welcome{
background:
linear-gradient(
135deg,
#8b5cf6,
#3b82f6
);

padding:30px;
border-radius:20px;

margin-bottom:30px;
}

.welcome h1{
margin-bottom:10px;
}

.cards{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));

gap:20px;
}

.card{
background:#1e293b;

padding:25px;

border-radius:20px;

transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.icon{
font-size:40px;
margin-bottom:15px;
}

.card h2{
margin-bottom:10px;
}

.btn{
display:inline-block;
margin-top:15px;

padding:10px 20px;

background:#8b5cf6;

color:white;

text-decoration:none;

border-radius:10px;
}

.btn:hover{
background:#7c3aed;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">
🚀 SmartSub
</div>

<a href="dashboard.php">
🏠 Dashboard
</a>

<a href="plans.php">
📋 Plans
</a>

<a href="activity.php">
📊 Activity
</a>

<a href="logout.php">
🚪 Logout
</a>

</div>

<div class="main">

<div class="welcome">

<h1>
Welcome,
<?php echo $_SESSION['name']; ?>
👋
</h1>

<p>
Current Plan:
<b>
<?php echo $_SESSION['plan']; ?>
</b>
</p>

</div>

<div class="cards">

<div class="card">

<div class="icon">
📋
</div>

<h2>
Subscription Plans
</h2>

<p>
Upgrade your account.
</p>

<a href="plans.php" class="btn">
View Plans
</a>

</div>

<div class="card">

<div class="icon">
💳
</div>

<h2>
Payment Center
</h2>

<p>
Manage subscriptions.
</p>

<a href="plans.php" class="btn">
Open
</a>

</div>

<div class="card">

<div class="icon">
📊
</div>

<h2>
Activity Log
</h2>

<p>
Track user activities.
</p>

<a href="activity.php" class="btn">
Open
</a>

</div>

<div class="card">

<div class="icon">
🚪
</div>

<h2>
Logout
</h2>

<p>
Secure logout.
</p>

<a href="logout.php" class="btn">
Logout
</a>

</div>

</div>

</div>

</body>
</html>