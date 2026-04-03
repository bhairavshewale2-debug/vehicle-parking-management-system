<?php
include 'db_config.php';

$conn = mysqli_connect("localhost","root","","vehicle_db");


$owner = "";
$vehicle = "";
$result = null;

if(isset($_GET['search'])){

    $owner = mysqli_real_escape_string($conn, $_GET['owner_name']);
    $vehicle = mysqli_real_escape_string($conn, $_GET['vehicle_no']);

    $query = "SELECT * FROM vehicle WHERE 1";

    if(!empty($owner)){
        $query .= " AND owner_name LIKE '%$owner%'";
    }

    if(!empty($vehicle)){
        $query .= " AND vehicle_no LIKE '%$vehicle%'";
    }

    $result = mysqli_query($conn,$query);
}
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<title>Search Vehicle</title>
<link rel="stylesheet" href="style.css">

<style>
.center-box{
    width:600px;
    margin:auto;
    margin-top:50px;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px gray;
}

table{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
}

th,td{
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#007BFF;
    color:white;
}

form input{
    width:100%;
    padding:12px;
    border-radius:6px;
    border:1px solid #ccc;
}

form button{
    padding:12px;
    background:#007BFF;
    color:white;
    border:none;
    border-radius:6px;
}

.reset-btn{
    display:block;
    padding:10px;
    background:#ef4444;
    color:white;
    border-radius:6px;
    text-decoration:none;
}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="main-container">

<?php include 'sidebar.php'; ?>

<div class="content">

<div class="center-box">

<h2 style="text-align:center;">
<i class="fa fa-search"></i> Search Vehicle
</h2>

<form method="GET" style="display:flex; flex-direction:column; gap:10px;">

<input type="text" name="owner_name" placeholder="Enter Owner Name"
value="<?php echo $owner; ?>">

<input type="text" name="vehicle_no" placeholder="Enter Vehicle Number"
value="<?php echo $vehicle; ?>">

<button type="submit" name="search">Search</button>

<a href="search.php" class="reset-btn" style="text-align:center;">Reset</a>

</form>

<!-- SHOW RESULT ONLY AFTER SEARCH -->
<?php if($result){ ?>

<table>
<tr>
<th>ID</th>
<th>Owner</th>
<th>Vehicle</th>
<th>Status</th>
<th>Slot</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['ticket_id']; ?></td>
<td><?php echo $row['owner_name']; ?></td>
<td><?php echo $row['vehicle_no']; ?></td>
<td><?php echo $row['current_status']; ?></td>
<td><?php echo $row['slot_number']; ?></td>
</tr>
<?php } ?>

</table>

<?php } ?>

</div>

</div>
</div>

</body>
</html>