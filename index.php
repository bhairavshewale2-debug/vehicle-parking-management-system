<?php
include 'db_config.php';
$conn = mysqli_connect("localhost","root","","vehicle_db");


$p = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE current_status='Parked'"));
$r = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE current_status='Released'"));
$earn = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(parking_charges) AS total FROM vehicle"));
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
<title>Home - Parking System</title>
<link rel="stylesheet" href="style.css">

<style>

/* 🔥 BACKGROUND */
body{
    margin:0;
    font-family:Arial;

    background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)),
    url("https://images.unsplash.com/photo-1506521781263-d8422e82f27a");

    background-size: cover;
    background-position: center;
    color:white;
}


/* CENTER CONTENT */
.home-container{
    text-align:center;
    margin-top:80px;
    padding:20px;
}

/* TITLE */
.main-title{
    font-size:36px;
    margin-bottom:15px;
    color:white;
    letter-spacing:1px;
}

/* SUBTITLE */
.subtitle{
    color:#ddd;
    margin-bottom:40px;
    font-size:16px;
}

/* STATS GRID (SPACING FIXED HERE) */
.stats{
    display:flex;
    justify-content:center;
    gap:40px;   /* 👈 MAIN SPACE */
    flex-wrap:wrap;
    margin-bottom:50px;
}

/* CARD */
.stat-box{
    background: rgba(255,255,255,0.95);  /* solid look */
    color: #111;   /* dark text */
    padding:25px;
    border-radius:15px;
    width:220px;
    box-shadow:0 10px 25px rgba(0,0,0,0.4);
}

.stat-box h2{
    font-size:32px;
    font-weight:bold;
    color:#000;   /* pure black */
}

.stat-box p{
    color:#444;
    font-size:15px;
}

.icon{
    font-size:30px;
    margin-bottom:10px;
    display:block;
}

.stat-box{
    border:1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(5px);
}

/* HOVER EFFECT */
.stat-box:hover{
    transform:translateY(-8px);
}

/* ICON */
.icon{
    font-size:30px;
    margin-bottom:10px;
}

/* COLORS */
.blue{color:#3b82f6;}
.green{color:#22c55e;}
.orange{color:#f97316;}

/* NUMBER */
.stat-box h2{
    font-size:28px;
    margin:10px 0;
}

/* BUTTON AREA */
.actions{
    margin-top:20px;
}

/* BUTTON */
.actions a{
    display:inline-block;
    padding:12px 25px;
    margin:15px;   /* 👈 BUTTON SPACE */
    background:#007BFF;
    color:white;
    border-radius:10px;
    text-decoration:none;
    transition:0.3s;
}

/* BUTTON HOVER */
.actions a:hover{
    background:#0056b3;
    transform:scale(1.05);
}

/* ICON SPACE */
.actions a i{
    margin-right:8px;
}

.stat-box{
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(5px);
}

</style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="main-container">

<?php include 'sidebar.php'; ?>

<div class="content">

<div class="home-container">

<!-- 🔥 NEW PROFESSIONAL HEADLINE -->
<h1 class="main-title">
    <i class="fa fa-parking"></i>  Smart Parking Management System
</h1>

<p class="subtitle">
    <i class="fa fa-chart-line"></i>  Monitor, manage, and control your parking operations efficiently
</p>

<!-- 📊 STATS -->
<div class="stats">

<div class="stat-box">
<i class="fa fa-car icon blue"></i>
<h2><?php echo $p['total']; ?></h2>
<p>Parked</p>
</div>

<div class="stat-box">
<i class="fa fa-check-circle icon green"></i>
<h2><?php echo $r['total']; ?></h2>
<p>Released</p>
</div>

<div class="stat-box">
<i class="fa fa-money-bill-wave icon orange"></i>
<h2>₹<?php echo $earn['total'] ?? 0; ?></h2>
<p>Earnings</p>
</div>

</div>

<div class="actions">

<a href="vehicle.php"><i class="fa fa-plus"></i> Add Vehicle</a>
<a href="view.php"><i class="fa fa-list"></i> Records</a>
<a href="slots.php"><i class="fa fa-parking"></i> Slots</a>
<a href="search.php"><i class="fa fa-search"></i> Search</a>

</div>

</div>

</div>

</div>
</div>

</body>
</html>