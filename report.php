<?php
include 'db_config.php';

$conn = mysqli_connect("localhost","root","","vehicle_db");

/* DATA */
$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle"));
$parked = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE current_status='Parked'"));
$released = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE current_status='Released'"));

$today = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total FROM vehicle WHERE DATE(entry_time)=CURDATE()
"));

$paid = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total FROM vehicle WHERE payment_status='Paid'
"));

$pending = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total FROM vehicle WHERE payment_status='Pending'
"));

$earn = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(parking_charges) AS total FROM vehicle
"));

$today_earn = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(parking_charges) AS total FROM vehicle 
WHERE DATE(entry_time)=CURDATE()
"));

$month_earn = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(parking_charges) AS total FROM vehicle 
WHERE MONTH(entry_time)=MONTH(CURDATE()) 
AND YEAR(entry_time)=YEAR(CURDATE())
"));

$total_slots = 10;
?>

<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
<title>Parking Report</title>
<link rel="stylesheet" href="style.css">

<style>
.report-box{
    width:700px;
    margin:auto;
    margin-top:30px;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px gray;
}

table{
    width:100%;
    border-collapse:collapse;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

.label{
    font-weight:bold;
}

.print-btn{
    margin-top:20px;
    padding:10px 20px;
    background:#007BFF;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

@media print {

    /* Hide everything */
    body * {
        visibility: hidden;
    }

    /* Show only report */
    .report-box, .report-box * {
        visibility: visible;
    }

    /* Position report properly */
    .report-box {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none;
    }

    /* Hide print button also */
    .print-btn {
        display: none;
    }
}
</style>

</head>

<body>

<!-- HEADER -->
<?php include 'header.php'; ?>

<div class="main-container">

<!-- SIDEBAR -->
<?php include 'sidebar.php'; ?>

<!-- CONTENT -->
<div class="content">

<div class="report-box">

<h2 class="title">
    <i class="fa fa-chart-line"></i> Parking Report
</h2>

<table>

<tr><td class="label">Total Vehicles</td><td><?php echo $total['total']; ?></td></tr>
<tr><td class="label">Currently Parked</td><td><?php echo $parked['total']; ?></td></tr>
<tr><td class="label">Released Vehicles</td><td><?php echo $released['total']; ?></td></tr>
<tr><td class="label">Today's Vehicles</td><td><?php echo $today['total']; ?></td></tr>
<tr><td class="label">Paid Vehicles</td><td><?php echo $paid['total']; ?></td></tr>
<tr><td class="label">Pending Payments</td><td><?php echo $pending['total']; ?></td></tr>

<tr><td class="label">Total Earnings</td><td>₹<?php echo $earn['total'] ?? 0; ?></td></tr>
<tr><td class="label">Today's Earnings</td><td>₹<?php echo $today_earn['total'] ?? 0; ?></td></tr>

<tr><td class="label">Slots Used</td>
<td><?php echo $parked['total']; ?> / <?php echo $total_slots; ?></td></tr>

</table>

<center>
<button class="print-btn" onclick="window.print()">🖨 Print Report</button>
</center>

</div>

</div>
</div>

</body>
</html>