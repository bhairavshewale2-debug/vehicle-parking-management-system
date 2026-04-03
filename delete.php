<?php
$conn = mysqli_connect("localhost","root","","vehicle_db");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM vehicle WHERE ticket_id=$id");

header("Location:view.php");
?>