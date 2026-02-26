<?php
session_start();
include("db.php");

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit();
}

/* ===== CALORIE GOAL LOGIC ===== */

$goal = 2000; // You can change this value

$result = mysqli_query($conn,"SELECT SUM(calories) as total FROM foods");
$data = mysqli_fetch_assoc($result);

$totalCalories = $data['total'] ? $data['total'] : 0;

$percentage = ($totalCalories / $goal) * 100;
if($percentage > 100){
    $percentage = 100;
}

$remaining = $goal - $totalCalories;
if($remaining < 0){
    $remaining = 0;
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
font-family:'Segoe UI',sans-serif;
}

body{
min-height:100vh;
background:linear-gradient(-45deg,#1d2671,#c33764,#0f2027,#2c5364);
background-size:400% 400%;
animation:gradientBG 12s ease infinite;
color:white;
}

@keyframes gradientBG{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.nav{
display:flex;
justify-content:space-between;
padding:20px 50px;
background:rgba(0,0,0,0.6);
backdrop-filter:blur(10px);
}

.nav a{
color:white;
text-decoration:none;
margin-left:20px;
transition:0.3s;
}

.nav a:hover{
color:#00ffcc;
}

.container{
padding:60px;
text-align:center;
animation:fadeIn 1.5s ease;
}

@keyframes fadeIn{
from{opacity:0;transform:translateY(20px);}
to{opacity:1;transform:translateY(0);}
}

.card-container{
display:flex;
justify-content:center;
gap:30px;
margin-top:50px;
flex-wrap:wrap;
}

.card{
background:rgba(255,255,255,0.1);
padding:30px;
border-radius:20px;
width:260px;
backdrop-filter:blur(15px);
transition:0.4s;
position:relative;
overflow:hidden;
}

.card:hover{
transform:translateY(-12px);
box-shadow:0 0 25px rgba(0,255,204,0.6);
}

.card::before{
content:"";
position:absolute;
top:0;
left:-100%;
width:100%;
height:100%;
background:linear-gradient(120deg,transparent,rgba(255,255,255,0.4),transparent);
transition:0.6s;
}

.card:hover::before{
left:100%;
}

.btn{
display:inline-block;
margin-top:20px;
padding:10px 25px;
border-radius:25px;
text-decoration:none;
color:white;
transition:0.3s;
}

.green{background:#28a745;}
.green:hover{box-shadow:0 0 15px #28a745;}

.blue{background:#007bff;}
.blue:hover{box-shadow:0 0 15px #007bff;}

.red{
background:#ff4d4d;
animation:pulse 2s infinite;
}

.red:hover{box-shadow:0 0 20px #ff0000;}

@keyframes pulse{
0%{box-shadow:0 0 5px #ff4d4d;}
50%{box-shadow:0 0 20px #ff0000;}
100%{box-shadow:0 0 5px #ff4d4d;}
}

/* ===== CALORIE GOAL CARD ===== */

.goal-card{
margin-top:60px;
background:rgba(255,255,255,0.1);
padding:40px;
border-radius:20px;
width:60%;
margin-left:auto;
margin-right:auto;
backdrop-filter:blur(15px);
animation:slideUp 1s ease;
}

@keyframes slideUp{
from{opacity:0; transform:translateY(30px);}
to{opacity:1; transform:translateY(0);}
}

.progress-bar{
width:100%;
background:rgba(255,255,255,0.2);
border-radius:20px;
overflow:hidden;
margin-top:20px;
height:25px;
}

.progress{
height:100%;
width:0%;
background:linear-gradient(90deg,#00ffcc,#00ccff);
border-radius:20px;
animation:loadProgress 2s forwards;
}

@keyframes loadProgress{
to{width:<?php echo $percentage; ?>%;}
}

.goal-stats{
margin-top:15px;
font-size:16px;
}

</style>
</head>

<body>

<div class="nav">
<div>🥗 NutriTrack</div>
<div>
<a href="add_food.php">Add Food</a>
<a href="delete_food.php">Delete Food</a>
<a href="view_food.php">View Records</a>
<a href="logout.php">Logout</a>
</div>
</div>

<div class="container">
<h1>Welcome, <?php echo $_SESSION['user']; ?> 👋</h1>
<p>Manage your nutrition smartly with professional tracking tools</p>

<div class="card-container">

<div class="card">
<h2>➕ Add Food</h2>
<p>Add calories, protein, carbs, fats,meal type & category.</p>
<a href="add_food.php" class="btn green">Add Now</a>
</div>

<div class="card">
<h2>📊 View Records</h2>
<p>Track your daily nutrition data.</p>
<a href="view_food.php" class="btn blue">View Records</a>
</div>

<div class="card">
<h2>🗑 Manage Records</h2>
<p>Delete unwanted food entries securely.</p>
<a href="delete_food.php" class="btn red">Delete Food</a>
</div>

</div>

<!-- ===== CALORIE GOAL SECTION ===== -->

<div class="goal-card">
<h2>🔥 Daily Calorie Goal Per Day</h2>
<p>Goal: <?php echo $goal; ?> kcal</p>

<div class="progress-bar">
<div class="progress"></div>
</div>

<div class="goal-stats">
<p>Total Consumed: <?php echo $totalCalories; ?> kcal</p>
<p>Remaining: <?php echo $remaining; ?> kcal</p>
<p><?php echo round($percentage); ?>% Completed</p>
</div>

</div>

</div>

</body>
</html>