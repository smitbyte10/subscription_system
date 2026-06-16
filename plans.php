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

<title>Subscription Plans</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#0f172a;
min-height:100vh;
color:white;
}

.header{
text-align:center;
padding:50px 20px;
}

.header h1{
font-size:50px;
margin-bottom:10px;
}

.header p{
color:#cbd5e1;
}

.container{
width:90%;
margin:auto;

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(300px,1fr));

gap:30px;

padding-bottom:50px;
}

.card{
background:#1e293b;

padding:35px;

border-radius:25px;

text-align:center;

transition:.4s;

position:relative;

overflow:hidden;
}

.card:hover{
transform:translateY(-10px);
}

.free{
border:2px solid #22c55e;
}

.basic{
border:2px solid #3b82f6;
}

.premium{
border:2px solid #f59e0b;
}

.icon{
font-size:60px;
margin-bottom:15px;
}

.plan{
font-size:35px;
font-weight:bold;
margin-bottom:10px;
}

.price{
font-size:45px;
font-weight:bold;
margin:20px 0;
}

.feature{
margin:12px 0;
color:#cbd5e1;
}

.btn{
display:inline-block;
margin-top:25px;

padding:12px 30px;

background:
linear-gradient(
135deg,
#8b5cf6,
#3b82f6
);

color:white;

text-decoration:none;

border-radius:12px;

transition:.3s;
}

.btn:hover{
opacity:.9;
}

.back{
position:absolute;
top:20px;
left:20px;

background:#111827;

padding:10px 20px;

border-radius:10px;

text-decoration:none;

color:white;
}

.badge{
position:absolute;
top:15px;
right:-35px;

background:#f59e0b;

padding:8px 40px;

transform:rotate(45deg);

font-size:12px;
font-weight:bold;
}

</style>

</head>

<body>

<a href="dashboard.php" class="back">
← Dashboard
</a>

<div class="header">

<h1>
Choose Your Plan
</h1>

<p>
Upgrade anytime and unlock premium features.
</p>

</div>

<div class="container">

<div class="card free">

<div class="icon">
🆓
</div>

<div class="plan">
FREE
</div>

<div class="price">
₹0
</div>

<div class="feature">✔ Basic Access</div>
<div class="feature">✔ Community Support</div>
<div class="feature">✔ Limited Features</div>

<a href="#" class="btn">
Current Plan
</a>

</div>

<div class="card basic">

<div class="icon">
⭐
</div>

<div class="plan">
BASIC
</div>

<div class="price">
₹199
</div>

<div class="feature">✔ All Free Features</div>
<div class="feature">✔ Priority Support</div>
<div class="feature">✔ Extra Storage</div>

<a href="payment.php?plan=Basic&amount=199"
class="btn">

Subscribe

</a>

</div>

<div class="card premium">

<div class="badge">
POPULAR
</div>

<div class="icon">
👑
</div>

<div class="plan">
PREMIUM
</div>

<div class="price">
₹499
</div>

<div class="feature">✔ Unlimited Access</div>
<div class="feature">✔ Premium Support</div>
<div class="feature">✔ Analytics Dashboard</div>
<div class="feature">✔ Everything Included</div>

<a href="payment.php?plan=Premium&amount=499"
class="btn">

Subscribe

</a>

</div>

</div>

</body>
</html>