<?php

$conn = mysqli_connect("localhost","root","","vehicle_db");

$name = $_POST['name'];
$vehicle = $_POST['vehicle'];

$sql = "INSERT INTO vehicle(name,vehicle_no)
VALUES('$name','$vehicle')";

if(mysqli_query($conn,$sql))
{
echo "Data Inserted Successfully";
}
else
{
echo "Error";
}

?>