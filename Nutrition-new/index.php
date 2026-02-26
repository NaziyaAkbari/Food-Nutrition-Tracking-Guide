<!DOCTYPE html>
<html>
<head>
<title>NutriTrack | Food Nutrition System</title>
<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
height:100vh;
animation: bgSlider 18s infinite;
color:white;
}

/* Background Slider */
@keyframes bgSlider{
0%{background:url('https://images.unsplash.com/photo-1490645935967-10de6ba17061') center/cover no-repeat;}
33%{background:url('https://images.unsplash.com/photo-1504674900247-0877df9cc836') center/cover no-repeat;}
66%{background:url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c') center/cover no-repeat;}
100%{background:url('https://images.unsplash.com/photo-1490645935967-10de6ba17061') center/cover no-repeat;}
}

.overlay{
position:fixed;
width:100%;
height:100%;
background:rgba(0,0,0,0.7);
}

.navbar{
position:fixed;
width:100%;
display:flex;
justify-content:space-between;
padding:20px 60px;
background:rgba(0,0,0,0.6);
backdrop-filter:blur(10px);
z-index:10;
}

.navbar a{
color:white;
text-decoration:none;
margin-left:20px;
transition:0.3s;
}

.navbar a:hover{
color:#00ffcc;
}

.hero{
position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
text-align:center;
animation:fadeIn 2s ease-in-out;
}

.hero h1{
font-size:50px;
animation:float 3s infinite alternate;
}

.hero p{
margin-top:15px;
font-size:20px;
}

.btn{
display:inline-block;
margin-top:25px;
padding:12px 30px;
background:#28a745;
border-radius:30px;
text-decoration:none;
color:white;
transition:0.4s;
}

.btn:hover{
transform:scale(1.1);
box-shadow:0 0 20px #28a745;
}

@keyframes fadeIn{
from{opacity:0;transform:translate(-50%,-60%);}
to{opacity:1;transform:translate(-50%,-50%);}
}

@keyframes float{
from{transform:translateY(-10px);}
to{transform:translateY(10px);}
}

</style>
</head>
<body>

<div class="overlay"></div>

<div class="navbar">
<div>🥗 NutriTrack</div>
<div>
<a href="index.php">Home</a>
<a href="login.php">Login</a>
<a href="register.php">Register</a>
</div>
</div>

<div class="hero">
<h1>Track Your Nutrition Smartly</h1>
<p>Professional food nutrition tracking system</p>
<a href="register.php" class="btn">Get Started</a>
</div>

</body>
</html>