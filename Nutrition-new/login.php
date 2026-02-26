<?php
session_start();
include("db.php");

if(isset($_POST['login'])){
$email=$_POST['email'];
$password=$_POST['password'];

$result=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
$row=mysqli_fetch_assoc($result);

if($row && password_verify($password,$row['password'])){
$_SESSION['user']=$row['name'];
header("Location: dashboard.php");
exit();
}else{
$error="Invalid Credentials!";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(-45deg,#1e3c72,#2a5298,#16a085,#27ae60);
background-size:400% 400%;
animation:gradient 10s ease infinite;
font-family:sans-serif;
}

@keyframes gradient{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.box{
background:rgba(255,255,255,0.1);
padding:40px;
border-radius:20px;
backdrop-filter:blur(15px);
color:white;
text-align:center;
width:350px;
}

input{
width:100%;
padding:10px;
margin:10px 0;
border:none;
border-radius:8px;
}

button{
padding:10px 25px;
border:none;
border-radius:25px;
background:#28a745;
color:white;
cursor:pointer;
transition:0.4s;
}

button:hover{
box-shadow:0 0 15px #28a745;
}

a{color:#00ffcc;text-decoration:none;}

</style>
</head>
<body>

<div class="box">
<h2>Login</h2>
<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>
<p>Don't have account? <a href="register.php">Register</a></p>
</div>

</body>
</html>