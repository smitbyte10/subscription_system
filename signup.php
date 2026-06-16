<?php

include("config.php");

if(isset($_POST['signup']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$password=md5($_POST['password']);

$check=mysqli_query($conn,
"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check)>0)
{
echo "<script>alert('Email Already Exists');</script>";
}
else
{
mysqli_query($conn,

"INSERT INTO users(name,email,password)

VALUES('$name','$email','$password')"

);

echo "<script>
alert('Registration Successful');
window.location='login.php';
</script>";
}
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Create Account</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:
linear-gradient(
135deg,
#667eea,
#764ba2
);
}

.container{
width:420px;
padding:35px;
background:
rgba(255,255,255,.15);

backdrop-filter:blur(15px);

border-radius:25px;

box-shadow:
0 8px 32px
rgba(0,0,0,.25);
}

h1{
text-align:center;
color:white;
margin-bottom:25px;
}

input{
width:100%;
padding:14px;
margin:10px 0;
border:none;
border-radius:12px;
font-size:15px;
}

button{
width:100%;
padding:14px;
margin-top:10px;

background:#22c55e;

color:white;
font-size:16px;

border:none;
border-radius:12px;

cursor:pointer;
}

button:hover{
background:#16a34a;
}

p{
text-align:center;
margin-top:15px;
color:white;
}

a{
color:yellow;
text-decoration:none;
font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h1>🚀 Create Account</h1>

<form method="post">

<input
type="text"
name="name"
placeholder="Full Name"
required>

<input
type="email"
name="email"
placeholder="Email Address"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="signup">

Create Account

</button>

</form>

<p>

Already have an account?

<a href="login.php">

Login

</a>

</p>

</div>

</body>
</html>