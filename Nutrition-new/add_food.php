<?php
session_start();
include("db.php");

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit();
}

$success = "";
$error = "";

if(isset($_POST['add'])){

$name = mysqli_real_escape_string($conn,$_POST['food_name']);
$cal = intval($_POST['calories']);
$protein = intval($_POST['protein']);
$carbs = intval($_POST['carbs']);
$fats = intval($_POST['fats']);
$meal = mysqli_real_escape_string($conn,$_POST['meal_type']);
$category = mysqli_real_escape_string($conn,$_POST['category']);

$stmt = $conn->prepare("INSERT INTO foods 
(food_name, calories, protein, carbs, fats, meal_type, category) 
VALUES (?, ?, ?, ?, ?, ?, ?)");

if($stmt){
$stmt->bind_param("siiiiss", $name, $cal, $protein, $carbs, $fats, $meal, $category);

if($stmt->execute()){
    $success = "✨ Food Added Successfully!";
} else {
    $error = "Insert Error: " . $stmt->error;
}

$stmt->close();
} else {
$error = "Prepare Failed: " . $conn->error;
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Food</title>

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
background:linear-gradient(-45deg,#ff512f,#dd2476,#1fa2ff,#12d8fa);
background-size:400% 400%;
animation:gradientMove 10s ease infinite;
}

@keyframes gradientMove{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.box{
background:rgba(255,255,255,0.1);
padding:45px;
border-radius:25px;
backdrop-filter:blur(20px);
color:white;
width:420px;
text-align:center;
animation:slideUp 0.8s ease;
box-shadow:0 0 30px rgba(0,0,0,0.3);
}

@keyframes slideUp{
from{opacity:0; transform:translateY(40px);}
to{opacity:1; transform:translateY(0);}
}

h2{
margin-bottom:25px;
}

.form-group{
position:relative;
margin-bottom:22px;
}

.form-group input,
.form-group select{
width:100%;
padding:12px;
border:none;
border-radius:8px;
outline:none;
font-size:14px;
}

.form-group label{
position:absolute;
left:12px;
top:12px;
color:#ddd;
pointer-events:none;
transition:0.3s;
}

.form-group input:focus + label,
.form-group input:valid + label{
top:-10px;
font-size:12px;
color:#00ffcc;
}

select{
background:white;
color:black;
}

button{
margin-top:15px;
padding:12px 30px;
border:none;
border-radius:25px;
background:#28a745;
color:white;
cursor:pointer;
font-weight:bold;
transition:0.4s;
}

button:hover{
transform:translateY(-3px);
box-shadow:0 0 20px #28a745;
}

.success{
margin-bottom:15px;
padding:12px;
background:rgba(0,255,150,0.2);
border-radius:10px;
animation:fadeIn 0.5s ease;
}

.error{
margin-bottom:15px;
padding:12px;
background:rgba(255,0,0,0.3);
border-radius:10px;
animation:fadeIn 0.5s ease;
}

@keyframes fadeIn{
from{opacity:0;}
to{opacity:1;}
}

</style>
</head>
<body>

<div class="box">

<h2>🍽 Add Food Entry</h2>

<?php if($success) echo "<div class='success'>$success</div>"; ?>
<?php if($error) echo "<div class='error'>$error</div>"; ?>

<form method="POST">

<div class="form-group">
<input type="text" name="food_name" required>
<label>Food Name</label>
</div>

<div class="form-group">
<input type="number" name="calories" required>
<label>Calories</label>
</div>

<div class="form-group">
<input type="number" name="protein" required>
<label>Protein (g)</label>
</div>

<div class="form-group">
<input type="number" name="carbs" required>
<label>Carbs (g)</label>
</div>

<div class="form-group">
<input type="number" name="fats" required>
<label>Fats (g)</label>
</div>

<div class="form-group">
<select name="meal_type" required>
<option value="">Select Meal Type</option>
<option>Breakfast</option>
<option>Lunch</option>
<option>Dinner</option>
<option>Snacks</option>
</select>
</div>

<div class="form-group">
<select name="category" required>
<option value="">Select Food Category</option>
<option>Veg</option>
<option>Non-Veg</option>
<option>Vegan</option>
<option>Dairy</option>
<option>Drinks</option>
</select>
</div>

<button type="submit" name="add">Add Food</button>

</form>

</div>

</body>
</html>