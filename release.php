<?php
$conn = mysqli_connect("localhost","root","","vehicle_db");

if(!$conn){
    die("Connection Failed");
}

$id = $_GET['id'];

/* Get entry time + category */
$res = mysqli_query($conn,"SELECT entry_time, category FROM vehicle WHERE ticket_id=$id");
$row = mysqli_fetch_assoc($res);

$entry = $row['entry_time'];
$category = $row['category'];

/* Total minutes */
$d = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT TIMESTAMPDIFF(MINUTE,'$entry',NOW()) AS total_min"));

$total_min = $d['total_min'];

/* Convert to hours + minutes */
$hours = floor($total_min / 60);
$minutes = $total_min % 60;

/* Format duration */
$formatted_duration = $hours . "h : " . $minutes . "min";

/* Charge calculation (per hour) */
$rate = ($category == "2-Wheeler") ? 20 : 50;

/* Always round up hours */
$charge_hours = ceil($total_min / 60);
$total_charge = $charge_hours * $rate;

/* Update database */
mysqli_query($conn,"UPDATE vehicle SET
current_status='Released',
exit_time=NOW(),
duration='$formatted_duration',
parking_charges='$total_charge',
payment_status='Paid'
WHERE ticket_id=$id");

/* Redirect */
header("Location: view.php");
?>