<?php
$conn = mysqli_connect("localhost","root","","vehicle_db");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}
?>