<?php
session_start();
include("db.php");

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit();
}

$result = mysqli_query($conn,"SELECT * FROM foods ORDER BY id DESC");

$totalCalories = 0;
$totalProtein = 0;
$totalCarbs = 0;
$totalFats = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>View Food Records</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
min-height:100vh;
background:linear-gradient(-45deg,#0f2027,#203a43,#2c5364,#1c92d2);
background-size:400% 400%;
animation:gradientBG 12s ease infinite;
color:white;
padding:40px;
}

@keyframes gradientBG{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.header a{
text-decoration:none;
color:white;
background:#28a745;
padding:8px 18px;
border-radius:20px;
transition:0.3s;
}

.header a:hover{
box-shadow:0 0 15px #28a745;
}

/* Table Container */
.table-container{
background:rgba(255,255,255,0.1);
padding:30px;
border-radius:20px;
backdrop-filter:blur(15px);
animation:fadeIn 1.5s ease;
}

@keyframes fadeIn{
from{opacity:0;transform:translateY(20px);}
to{opacity:1;transform:translateY(0);}
}

table{
width:100%;
border-collapse:collapse;
text-align:center;
margin-bottom:30px;
}

th,td{
padding:12px;
}

th{
background:rgba(0,0,0,0.4);
}

tr{
transition:0.3s;
}

tr:hover{
background:rgba(255,255,255,0.2);
transform:scale(1.01);
}

/* Summary Cards */
.summary{
display:flex;
justify-content:space-between;
flex-wrap:wrap;
gap:20px;
}

.card{
flex:1;
min-width:180px;
padding:20px;
border-radius:15px;
text-align:center;
color:white;
font-weight:bold;
animation:pop 1s ease;
transition:0.4s;
}

.card:hover{
transform:translateY(-5px) scale(1.05);
}

@keyframes pop{
from{transform:scale(0.8);opacity:0;}
to{transform:scale(1);opacity:1;}
}

.calories{background:linear-gradient(45deg,#ff512f,#dd2476);}
.protein{background:linear-gradient(45deg,#11998e,#38ef7d);}
.carbs{background:linear-gradient(45deg,#396afc,#2948ff);}
.fats{background:linear-gradient(45deg,#f7971e,#ffd200);}

</style>

</head>
<body>

<div class="header">
<h1>🥗 Nutrition Records</h1>
<div>
<a href="dashboard.php">Dashboard</a>
<a href="logout.php">Logout</a>
</div>
</div>

<div class="table-container">

<table>
<tr>
<th>Food Name</th>
<th>Calories</th>
<th>Protein (g)</th>
<th>Carbs (g)</th>
<th>Fats (g)</th>
</tr>

<?php 
while($row = mysqli_fetch_assoc($result)){ 

$totalCalories += $row['calories'];
$totalProtein += $row['protein'];
$totalCarbs += $row['carbs'];
$totalFats += $row['fats'];
?>

<tr>
<td><?php echo $row['food_name']; ?></td>
<td><?php echo $row['calories']; ?></td>
<td><?php echo $row['protein']; ?></td>
<td><?php echo $row['carbs']; ?></td>
<td><?php echo $row['fats']; ?></td>
</tr>

<?php } ?>

</table>

<!-- Animated Summary Section -->
<div class="summary">

<div class="card calories">
🔥 Total Calories <br>
<?php echo $totalCalories; ?> kcal
</div>

<div class="card protein">
💪 Total Protein <br>
<?php echo $totalProtein; ?> g
</div>

<div class="card carbs">
🍞 Total Carbs <br>
<?php echo $totalCarbs; ?> g
</div>

<div class="card fats">
🥑 Total Fats <br>
<?php echo $totalFats; ?> g
</div>

</div>

</div>

</body>
</html>