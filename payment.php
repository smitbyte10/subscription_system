<?php

session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$plan=$_GET['plan'] ?? '';
$amount=$_GET['amount'] ?? '';

if(isset($_POST['complete_payment']))
{
    $method=$_POST['payment_method'];
    $user_id=$_SESSION['user_id'];

    mysqli_query($conn,

    "INSERT INTO payments
    (user_id,plan,amount,payment_method)

    VALUES
    ('$user_id',
    '$plan',
    '$amount',
    '$method')"

    );

    mysqli_query($conn,

    "UPDATE users
    SET plan='$plan'
    WHERE id='$user_id'"

    );

    mysqli_query($conn,

    "INSERT INTO activity_log
    (user_id,activity)

    VALUES
    ('$user_id',
    'Payment Successful via $method for $plan Plan')"

    );

    $_SESSION['plan']=$plan;

    echo "
    <script>
    alert('Payment Successful!');
    window.location='dashboard.php';
    </script>
    ";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Premium Payment Gateway</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

    ```css id="qj71xh"
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
padding:20px;

background:
linear-gradient(
135deg,
#0f172a,
#1e293b,
#312e81
);
}

.container{
width:1100px;
max-width:100%;

background:
rgba(255,255,255,.08);

backdrop-filter:blur(18px);

padding:35px;

border-radius:30px;

box-shadow:
0 8px 32px rgba(0,0,0,.35);

color:white;
}

.header{
text-align:center;
margin-bottom:30px;
}

.header h1{
font-size:45px;
margin-bottom:10px;
}

.header p{
color:#cbd5e1;
}

.plan-box{
text-align:center;

background:
rgba(255,255,255,.08);

padding:25px;

border-radius:20px;

margin-bottom:35px;
}

.plan-box h2{
font-size:35px;
margin-bottom:10px;
}

.amount{
font-size:55px;
font-weight:bold;
color:#22c55e;
}

.payment-grid{
display:grid;

grid-template-columns:
repeat(auto-fit,minmax(220px,1fr));

gap:25px;
}

.card{
background:
rgba(255,255,255,.08);

padding:25px;

border-radius:20px;

text-align:center;

cursor:pointer;

transition:.3s;

border:2px solid transparent;
}

.card:hover{
transform:translateY(-8px);

border-color:#8b5cf6;
}

.card img{
width:90px;
height:90px;

object-fit:contain;

margin-bottom:15px;
}

.card h3{
margin-bottom:15px;
}

.card button{
width:100%;

padding:12px;

border:none;

border-radius:12px;

cursor:pointer;

background:
linear-gradient(
135deg,
#8b5cf6,
#3b82f6
);

color:white;
font-size:15px;
}

.card button:hover{
opacity:.9;
}

.upi-section{
display:none;

margin-top:35px;

background:
rgba(255,255,255,.08);

padding:25px;

border-radius:20px;
}

.upi-section h3{
margin-bottom:15px;
}

.upi-section input{
width:100%;

padding:15px;

border:none;

border-radius:12px;

margin-bottom:15px;
}

.upi-section button{
padding:14px 25px;

border:none;

border-radius:12px;

background:
linear-gradient(
135deg,
#22c55e,
#16a34a
);

color:white;

cursor:pointer;
}

.modal{
display:none;

position:fixed;

left:0;
top:0;

width:100%;
height:100%;

background:
rgba(0,0,0,.75);

z-index:9999;
}

.modal-content{
width:450px;

max-width:95%;

background:white;

padding:30px;

border-radius:25px;

text-align:center;

position:absolute;

top:50%;
left:50%;

transform:
translate(-50%,-50%);

color:black;
}

.close{
position:absolute;

right:20px;
top:15px;

font-size:35px;

cursor:pointer;
}

.qr-image{
width:250px;
height:250px;

object-fit:contain;

margin:20px 0;
}

.modal-content input{
width:100%;

padding:15px;

border:1px solid #ddd;

border-radius:12px;

margin:15px 0;
}

.modal-content button{
width:100%;

padding:15px;

border:none;

border-radius:12px;

cursor:pointer;

background:
linear-gradient(
135deg,
#22c55e,
#16a34a
);

color:white;

font-size:16px;
}
```


/* PASTE PART 2 CSS HERE */

</style>

</head>

<body>

<div class="container">

<div class="header">

<h1>💳 Secure Payment Gateway</h1>

<p>
Choose your preferred payment method
</p>

</div>

<div class="plan-box">

<h2>
<?php echo $plan; ?>
</h2>

<div class="amount">
₹<?php echo $amount; ?>
</div>

</div>

<form method="post" id="paymentForm">

<input
type="hidden"
name="payment_method"
id="payment_method">

<div class="payment-grid">

<!-- PhonePe -->

<div class="card"
onclick="selectMethod('PhonePe')">

<img src="images/PhonePe.webp">

<h3>PhonePe</h3>

<button
type="button"
onclick="openQR('PhonePe')">

📷 Scan QR

</button>

</div>

<!-- Google Pay -->

<div class="card"
onclick="selectMethod('gpay')">

<img src="images/gpay.webp">

<h3>Google Pay</h3>

<button
type="button"
onclick="openQR('gpay')">

📷 Scan QR

</button>

</div>

<!-- Paytm -->

<div class="card"
onclick="selectMethod('Paytm')">

<img src="images/Paytm.webp">

<h3>Paytm</h3>

<button
type="button"
onclick="openQR('Paytm')">

📷 Scan QR

</button>

</div>

<!-- UPI -->

<div class="card"
onclick="showUPISection()">

<img src="images/UPI.webp">

<h3>UPI ID</h3>

<button
type="button">

Enter UPI

</button>

</div>

<!-- PayPal -->

<div class="card"
onclick="selectMethod('PayPal')">

<img src="images/PayPal.webp">

<h3>PayPal</h3>

<button
type="button"
onclick="showPaypal()">

Pay Now

</button>

</div>

</div>

<div
class="upi-section"
id="upiSection">

<h3>Enter UPI ID</h3>

<input
type="text"
id="upi_id"
placeholder="example@oksbi">

<button
type="button"
onclick="verifyUPI()">

Verify UPI

</button>

</div>

</form>

</div>

<!-- QR Modal -->

<div
class="modal"
id="qrModal">

<div class="modal-content">

<span
class="close"
onclick="closeQR()">

&times;

</span>

<h2 id="modalTitle">
Scan QR & Pay
</h2>

<img
src="images/payment_qr.png"
class="qr-image">

<h3>
Amount:
₹<?php echo $amount; ?>
</h3>

<button
type="button"
onclick="showPinBox()">

I Have Paid

</button>

</div>

</div>

<!-- PIN Modal -->

<div
class="modal"
id="pinModal">

<div class="modal-content">

<h2>
Enter UPI PIN
</h2>

<input
type="password"
id="upi_pin"
maxlength="6"
placeholder="Enter UPI PIN">

<button
type="button"
onclick="completePayment()">

Pay Now

</button>

</div>

</div>

<script>

    javascript
function selectMethod(method)
{
document.getElementById(
'payment_method'
).value=method;
}

function openQR(method)
{
event.stopPropagation();

document.getElementById(
'payment_method'
).value=method;

document.getElementById(
'modalTitle'
).innerHTML=
method + " QR Payment";

document.getElementById(
'qrModal'
).style.display='block';
}

function closeQR()
{
document.getElementById(
'qrModal'
).style.display='none';
}

function showUPISection()
{
document.getElementById(
'upiSection'
).style.display='block';

document.getElementById(
'payment_method'
).value='UPI';
}

function verifyUPI()
{
var upi=document.getElementById(
'upi_id'
).value;

if(upi=="")
{
alert(
"Please Enter UPI ID"
);
return;
}

alert(
"UPI ID Verified Successfully"
);

showPinBox();
}

function showPaypal()
{
event.stopPropagation();

document.getElementById(
'payment_method'
).value='PayPal';

document.getElementById(
'pinModal'
).style.display='block';
}

function showPinBox()
{
document.getElementById(
'qrModal'
).style.display='none';

document.getElementById(
'pinModal'
).style.display='block';
}

function completePayment()
{
var pin=document.getElementById(
'upi_pin'
).value;

if(pin=="")
{
alert(
"Please Enter UPI PIN"
);
return;
}

if(pin.length<4)
{
alert(
"UPI PIN must be at least 4 digits"
);
return;
}

document.getElementById(
'pinModal'
).style.display='none';

document.getElementById(
'paymentForm'
).innerHTML +=
'<input type="hidden" name="complete_payment" value="1">';

document.getElementById(
'paymentForm'
).submit();
}

window.onclick=function(event)
{
var qr=document.getElementById(
'qrModal'
);

var pin=document.getElementById(
'pinModal'
);

if(event.target==qr)
{
qr.style.display='none';
}

if(event.target==pin)
{
pin.style.display='none';
}
}

/* PASTE PART 3 JAVASCRIPT HERE */

</script>

</body>
</html>