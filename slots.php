<?php
include 'db_config.php';

$conn = mysqli_connect("localhost","root","","vehicle_db");

$total_slots = 10;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
<title>Parking Slots</title>
<link rel="stylesheet" href="style.css">

<style>
.slot-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
}

.slot{
    padding:20px;
    border-radius:10px;
    text-align:center;
    color:white;
}

.free{background:#22c55e;}
.occupied{background:#ef4444;}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="main-container">

<?php include 'sidebar.php'; ?>

<div class="content">

<h2>🅿 Parking Slots Status</h2>

<div class="slot-grid">

<?php
for($i=1; $i<=$total_slots; $i++){

    $res = mysqli_query($conn,"
    SELECT * FROM vehicle 
    WHERE slot_number='$i' AND current_status='Parked'
    ");

    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
?>

<div class="slot occupied">
<h3>Slot <?php echo $i; ?></h3>
<p><?php echo $row['vehicle_no']; ?></p>
<p><?php echo $row['owner_name']; ?></p>
</div>

<?php
    }else{
?>

<div class="slot free">
<h3>Slot <?php echo $i; ?></h3>
<p>Available</p>
</div>

<?php
    }
}
?>

</div>

</div>
</div>

</body>
</html>