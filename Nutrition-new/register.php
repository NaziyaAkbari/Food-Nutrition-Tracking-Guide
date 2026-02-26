<?php
include("db.php");

if(isset($_POST['register'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')";
    mysqli_query($conn,$query);

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(-45deg,#667eea,#764ba2,#6a11cb,#2575fc);
background-size:400% 400%;
animation:gradientMove 10s ease infinite;
}

@keyframes gradientMove{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.container{
background:rgba(255,255,255,0.1);
padding:40px;
border-radius:20px;
width:350px;
backdrop-filter:blur(15px);
box-shadow:0 0 30px rgba(0,0,0,0.3);
animation:slideUp 0.8s ease;
color:white;
text-align:center;
}

@keyframes slideUp{
from{opacity:0; transform:translateY(50px);}
to{opacity:1; transform:translateY(0);}
}

h2{
margin-bottom:25px;
}

.form-group{
position:relative;
margin-bottom:25px;
}

.form-group input{
width:100%;
padding:12px;
background:transparent;
border:none;
border-bottom:2px solid white;
outline:none;
color:white;
font-size:15px;
}

.form-group label{
position:absolute;
left:0;
top:12px;
color:#ddd;
transition:0.3s;
pointer-events:none;
}

.form-group input:focus + label,
.form-group input:valid + label{
top:-10px;
font-size:12px;
color:#00ffcc;
}

button{
width:100%;
padding:12px;
border:none;
border-radius:25px;
background:#00ffcc;
color:#000;
font-weight:bold;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#00ccaa;
box-shadow:0 0 15px #00ffcc;
transform:translateY(-3px);
}

p{
margin-top:15px;
font-size:14px;
}

a{
color:#00ffcc;
text-decoration:none;
}

a:hover{
text-decoration:underline;
}

</style>

</head>
<body>

<div class="container">
<h2>Create Account ✨</h2>

<form method="POST">

<div class="form-group">
<input type="text" name="name" required>
<label>Full Name</label>
</div>

<div class="form-group">
<input type="email" name="email" required>
<label>Email</label>
</div>

<div class="form-group">
<input type="password" name="password" required>
<label>Password</label>
</div>

<button type="submit" name="register">Register</button>

</form>

<p>Already have account? <a href="login.php">Login</a></p>

</div>

</body>
</html>