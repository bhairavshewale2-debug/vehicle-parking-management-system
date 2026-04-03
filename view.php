<?php
$conn = mysqli_connect("localhost","root","","vehicle_db");

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $query = "SELECT * FROM vehicle 
              WHERE owner_name LIKE '%$search%' 
              OR vehicle_no LIKE '%$search%' 
              OR category LIKE '%$search%'
              ORDER BY ticket_id DESC";
}else{
    $query = "SELECT * FROM vehicle ORDER BY ticket_id DESC";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
<title>Records</title>
<link rel="stylesheet" href="style.css">
<style>
body{
font-family:Arial;
background:#f5f5f5;
}

h2{
text-align:center;
}

table{
border-collapse:collapse;
width:95%;
margin:auto;
margin-top:20px;
}

th,td{
border:1px solid gray;
padding:10px;
text-align:center;
}

th{
background:#007BFF;
color:white;
}

tr:hover{
background:#f2f2f2;
}

.nav{
text-align:center;
margin-top:20px;
}

.btn{
display:inline-block;
padding:10px 20px;
margin:5px;
background:#007BFF;
color:white;
text-decoration:none;
border-radius:5px;
}

.btn:hover{
background:#0056b3;
}

.green{
background:#28a745;
}

.green:hover{
background:#1e7e34;
}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="main-container">

<?php include 'sidebar.php'; ?>

<div class="content">

<h2> Parking Records</h2>

<div class="search-box">
    <form method="GET">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit">Search</button>
        <a href="view.php" class="reset-btn">Reset</a>
    </form>
</div>

<table>
<tr>
<th>ID</th>
<th>Owner</th>
<th>Vehicle</th>
<th>Category</th>
<th>Location</th>
<th>Slot</th>
<th>Entry</th>
<th>Exit</th>
<th>Duration</th>
<th>Status</th>
<th>Payment</th>
<th>Charge</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<tr>
<td><?php echo $row['ticket_id']; ?></td>
<td><?php echo $row['owner_name']; ?></td>
<td><?php echo $row['vehicle_no']; ?></td>
<td><?php echo $row['category']; ?></td>
<td><?php echo $row['location']; ?></td>
<td><?php echo $row['slot_number']; ?></td>
<td><?php echo $row['entry_time']; ?></td>
<td><?php echo $row['exit_time']; ?></td>
<td><?php echo $row['duration']; ?></td>
<td><?php echo $row['current_status']; ?></td>
<td><?php echo $row['payment_status']; ?></td>
<td><?php echo $row['parking_charges']; ?></td>

<td>
<?php
if($row['current_status']=="Parked"){
echo "<a href='release.php?id=".$row['ticket_id']."'>Release</a>";
}else{
echo "<a href='receipt.php?id=".$row['ticket_id']."'>Receipt</a>";
}
?>
</td>
</tr>
<?php } ?>
</table>

</div>
</div>

</body>
</html>
