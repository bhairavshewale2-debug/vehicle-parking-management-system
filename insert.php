<?php
$conn = mysqli_connect("localhost","root","","vehicle_db");

if(!$conn){
    die("Connection Failed");
}

$owner = $_POST['owner_name'];
$vehicle = $_POST['vehicle_no'];
$category = $_POST['category'];
$location = $_POST['location'];

$total_slots = 10;

/* Count parked */
/* SMART SLOT REUSE */
$slot = 0;

for($i=1; $i<=10; $i++){

    $check = mysqli_query($conn,"
    SELECT * FROM vehicle 
    WHERE slot_number='$i' AND current_status='Parked'
    ");

    if(mysqli_num_rows($check) == 0){
        $slot = $i;
        break;
    }
}

/* Parking full */
if($slot == 0){
    echo "<h2 style='color:red;text-align:center;'>❌ Parking Full</h2>";
    exit();
}

/* Insert */
mysqli_query($conn,
"INSERT INTO vehicle(owner_name,vehicle_no,category,parking_charges,slot_number,payment_status,location)
VALUES('$owner','$vehicle','$category',0,'$slot','Pending','$location')");

$res = mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicle WHERE current_status='Parked'");
$row = mysqli_fetch_assoc($res);

$occupied = $row['total'];
$remaining = $total_slots - $occupied;
?>

<!DOCTYPE html>
<html>
<head>
<title>Parking Slot Status</title>
<style>
body{
    font-family:Arial;
    background:#f5f5f5;
    text-align:center;
    margin-top:100px;
}
.box{
    background:white;
    padding:40px;
    width:400px;
    margin:auto;
    border-radius:10px;
    box-shadow:0 0 10px gray;
}
.success{
    color:green;
    font-size:20px;
}
.warning{
    color:red;
    font-weight:bold;
}
button{
    background:#007BFF;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:5px;
    cursor:pointer;
}
</style>
</head>

<body>

<div class="box">

<h2 class="success">✔ Vehicle Parked Successfully</h2>

<p><b>Total Slots:</b> <?php echo $total_slots; ?></p>
<p><b>Occupied:</b> <?php echo $occupied; ?></p>
<p><b>Available:</b> <?php echo $remaining; ?></p>

<?php
if($remaining <= 0){
    echo "<p class='warning'>⚠ Parking Full!</p>";
}
?>

<br>

<a href="vehicle.php">
<button>Go Back</button>
</a>

<br><br>


</div>

</body>
</html>