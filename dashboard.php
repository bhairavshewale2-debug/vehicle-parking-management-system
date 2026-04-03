
<?php
$conn = mysqli_connect("localhost","root","","vehicle_db");

/* Queries */
$p = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE current_status='Parked'"));
$r = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE current_status='Released'"));
$e = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(parking_charges) AS total FROM vehicle"));
$today = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE DATE(entry_time)=CURDATE()"));
$paid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE payment_status='Paid'"));
$pending = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE payment_status='Pending'"));

$duration = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(TIMESTAMPDIFF(MINUTE, entry_time, IFNULL(exit_time, NOW()))) AS total FROM vehicle"));

$total_min = $duration['total'] ?? 0;
$hours = floor($total_min / 60);
$minutes = $total_min % 60;
$formatted_duration = $hours . "h : " . $minutes . "min";

$total_slots = 10;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
<title>Report Dashboard</title>
<link rel="stylesheet" href="style.css">

<style>
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    margin-top:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    text-align:center;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h2{
    margin:10px 0;
}

.green{color:#22c55e;}
.blue{color:#3b82f6;}
.orange{color:#f97316;}
.red{color:#ef4444;}
.purple{color:#a855f7;}

.print-btn{
    margin-top:30px;
    padding:12px 25px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="main-container">

<?php include 'sidebar.php'; ?>

<div class="content">

<h1 class="title">Parking Dashboard</h1>


<div class="cards">

<div class="card">
<i class="fa fa-car blue"></i>
<h2><?php echo $p['total']; ?></h2>
<p>Parked Vehicles</p>
</div>

<div class="card">
<i class="fa fa-check-circle green"></i>
<h2><?php echo $r['total']; ?></h2>
<p>Released Vehicles</p>
</div>

<div class="card">
<i class="fa fa-calendar-day orange"></i>
<h2><?php echo $today['total']; ?></h2>
<p>Today Vehicles</p>
</div>

<div class="card">
<i class="fa fa-credit-card purple"></i>
<h2><?php echo $paid['total']; ?></h2>
<p>Paid Vehicles</p>
</div>

<div class="card">
<i class="fa fa-hourglass-half red"></i>
<h2><?php echo $pending['total']; ?></h2>
<p>Pending Payments</p>
</div>

<div class="card">
<i class="fa fa-money-bill-wave green"></i>
<h2>₹<?php echo $e['total'] ?? 0; ?></h2>
<p>Total Earnings</p>
</div>

<div class="card">
<i class="fa fa-coins blue"></i>
<h2>₹<?php echo $today_earn['total'] ?? 0; ?></h2>
<p>Today Earnings</p>
</div>

<div class="card">
<i class="fa fa-calendar-alt purple"></i>
<h2>₹<?php echo $month_earn['total'] ?? 0; ?></h2>
<p>Monthly Earnings</p>
</div>

<div class="card">
<i class="fa fa-parking orange"></i>
<h2><?php echo $p['total']; ?> / <?php echo $total_slots; ?></h2>
<p>Slots Used</p>
</div>


</div>

</div>
</div>

</body>
</html>