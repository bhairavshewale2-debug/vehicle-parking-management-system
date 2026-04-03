<?php
include 'db_config.php';

/* Check connection */
if(!isset($conn)){
    die("Connection variable not found");
}

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}

/* Get ID safely */
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

/* Run query */
$result = mysqli_query($conn, "SELECT * FROM vehicle WHERE ticket_id='$id'");

/* Check query */
if(!$result){
    die("Query Error: " . mysqli_error($conn));
}

/* Fetch data */
$row = mysqli_fetch_assoc($result);

/* Check data */
if(!$row){
    die("No record found");
}
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<title>Parking Receipt</title>

<style>
body{
    font-family:Arial;
    background:#f5f5f5;
}

.receipt{
    width:350px;
    margin:50px auto;
    padding:20px;
    background:white;
    border-radius:10px;
    box-shadow:0 0 10px gray;
}

h2{text-align:center;}
p{margin:8px 0;}

.print-btn{
    display:block;
    margin:20px auto;
    padding:10px;
    background:#007BFF;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
</style>

</head>

<body>

<div class="receipt">

<h2>🧾 Parking Receipt</h2>

<hr>

<p><b>Ticket ID:</b> <?php echo $row['ticket_id']; ?></p>
<p><b>Owner Name:</b> <?php echo $row['owner_name']; ?></p>
<p><b>Vehicle No:</b> <?php echo $row['vehicle_no']; ?></p>
<p><b>Category:</b> <?php echo $row['category']; ?></p>
<p><b>Location:</b> <?php echo $row['location']; ?></p>
<p><b>Slot:</b> <?php echo $row['slot_number']; ?></p>
<p><b>Duration:</b> <?php echo $row['duration']; ?></p>

<hr>

<p><b>Entry Time:</b> <?php echo $row['entry_time']; ?></p>
<p><b>Exit Time:</b> 
<?php echo ($row['exit_time'] ? $row['exit_time'] : "Not exited"); ?>
</p>

<hr>

<h3>Total Charge: ₹<?php echo isset($row['parking_charges']) ? $row['parking_charges'] : 0; ?></h3>

</div>

<button class="print-btn" onclick="window.print()">🖨️ Print Receipt</button>

</body>
</html>