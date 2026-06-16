php
<?php

session_start();
include("config.php");

$message="";

if(isset($_POST['login']))
{
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=md5($_POST['password']);

    $sql="SELECT * FROM users
          WHERE email='$email'
          AND password='$password'";

    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1)
    {
        $user=mysqli_fetch_assoc($result);

        $_SESSION['user_id']=$user['id'];
        $_SESSION['name']=$user['name'];
        $_SESSION['plan']=$user['plan'];

        mysqli_query($conn,

        "INSERT INTO activity_log
        (user_id,activity)

        VALUES
        ('".$user['id']."',
        'Logged In')"

        );

        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $message="Invalid Email or Password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#0f172a,#1e293b,#312e81);
}

.container{
width:420px;
padding:40px;
background:rgba(255,255,255,.08);
backdrop-filter:blur(18px);
border-radius:25px;
box-shadow:0 8px 32px rgba(0,0,0,.3);
}

.logo{
text-align:center;
font-size:55px;
margin-bottom:10px;
}

h1{
text-align:center;
color:white;
margin-bottom:25px;
}

input{
width:100%;
padding:15px;
margin:10px 0;
border:none;
border-radius:12px;
font-size:15px;
}

button{
width:100%;
padding:15px;
margin-top:15px;
background:linear-gradient(135deg,#8b5cf6,#3b82f6);
color:white;
border:none;
border-radius:12px;
font-size:16px;
cursor:pointer;
}

button:hover{
opacity:.9;
}

.error{
color:#ff6b6b;
text-align:center;
margin-bottom:10px;
}

p{
text-align:center;
margin-top:20px;
color:white;
}

a{
color:#facc15;
text-decoration:none;
}

</style>

</head>

<body>

<div class="container">

<div class="logo">🚀</div>

<h1>Welcome Back</h1>

<?php
if($message!="")
{
    echo "<div class='error'>$message</div>";
}
?>

<form method="post">

<input
type="email"
name="email"
placeholder="Enter Email"
required>

<input
type="password"
name="password"
placeholder="Enter Password"
required>

<button
type="submit"
name="login">

Login

</button>

</form>

<p>
Don't have an account?
<a href="signup.php">Create Account</a>
</p>

</div>

</body>
</html>
