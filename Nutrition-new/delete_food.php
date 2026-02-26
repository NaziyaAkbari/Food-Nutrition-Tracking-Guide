<?php
session_start();
include("db.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

// DELETE LOGIC (SECURE)
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("DELETE FROM foods WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: delete_food.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Delete Food</title>

<style>

body{
margin:0;
font-family:sans-serif;
background:linear-gradient(135deg,#141e30,#243b55);
color:white;
min-height:100vh;
}

.nav{
display:flex;
justify-content:space-between;
padding:20px 50px;
background:rgba(0,0,0,0.5);
}

.nav a{
color:white;
text-decoration:none;
margin-left:20px;
transition:0.3s;
}

.nav a:hover{
color:#ff4d4d;
}

.container{
padding:40px;
text-align:center;
}

.food-container{
display:flex;
flex-wrap:wrap;
justify-content:center;
gap:30px;
margin-top:40px;
}

.card{
background:rgba(255,255,255,0.1);
padding:25px;
border-radius:20px;
width:260px;
backdrop-filter:blur(10px);
transition:0.4s;
position:relative;
animation:fadeIn 0.6s ease-in-out;
}

.card:hover{
transform:translateY(-10px);
box-shadow:0 0 20px #ff4d4d;
}

.delete-btn{
display:inline-block;
margin-top:15px;
padding:8px 20px;
background:#ff4d4d;
border-radius:20px;
color:white;
text-decoration:none;
transition:0.3s;
cursor:pointer;
}

.delete-btn:hover{
box-shadow:0 0 15px red;
}

/* Fade In Animation */
@keyframes fadeIn{
from{opacity:0; transform:scale(0.9);}
to{opacity:1; transform:scale(1);}
}

/* Delete Animation */
.fade-out{
animation:removeCard 0.5s forwards;
}

@keyframes removeCard{
to{
opacity:0;
transform:scale(0.5);
height:0;
margin:0;
padding:0;
}
}

.no-data{
margin-top:40px;
font-size:18px;
opacity:0.7;
}

</style>

<script>
function deleteFood(id){
    if(confirm("Are you sure you want to delete this record?")){
        const card = document.getElementById("card-"+id);
        card.classList.add("fade-out");

        setTimeout(()=>{
            window.location.href = "delete_food.php?delete="+id;
        },500);
    }
}
</script>

</head>
<body>

<div class="nav">
<div>🥗 NutriTrack</div>
<div>
<a href="dashboard.php">Dashboard</a>
<a href="logout.php">Logout</a>
</div>
</div>

<div class="container">
<h1>Delete Food Records ❌</h1>
<p>Select a record to remove</p>

<div class="food-container">

<?php
$query = "SELECT * FROM foods ORDER BY id DESC";
$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>

<div class="card" id="card-<?php echo $row['id']; ?>">

<h3><?php echo htmlspecialchars($row['food_name']); ?></h3>

<p>Calories: <?php echo htmlspecialchars($row['calories']); ?></p>
<p>Protein: <?php echo htmlspecialchars($row['protein']); ?> g</p>
<p>Carbs: <?php echo htmlspecialchars($row['carbs']); ?> g</p>
<p>Fats: <?php echo htmlspecialchars($row['fats']); ?> g</p>

<button class="delete-btn" onclick="deleteFood(<?php echo $row['id']; ?>)">
Delete
</button>

</div>

<?php
    }
}else{
    echo "<div class='no-data'>No food records found.</div>";
}
?>

</div>
</div>

</body>
</html>