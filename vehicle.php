<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <title>Vehicle Parking System</title>
  <link rel="stylesheet" href="style.css">

  <style>
  body{
    margin:0;
    padding:0;
    font-family:Arial;

    background-image:url("https://i.pinimg.com/736x/21/cd/f5/21cdf543a0b05c4555a71aae3f852510.jpg");
    background-size:cover;
    background-position:center;
  }

  .form-box {
    max-width:600px;
    margin:80px auto;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    color: white;
    padding:25px;
  }

  .title{
    color:#5a77c7;
    font-size:28px;
    margin-bottom:10px;
    text-align:center;
  }

  .subtitle{
    font-size:14px;
    color:#b0adad;
    margin-bottom:20px;
    text-align:center;
  }

  input, select{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid gray;
  }

  button{
    background:#007BFF;
    color:white;
    padding:12px;
    border:none;
    border-radius:6px;
    width:100%;
  }

  .footer{
    margin-top:15px;
    text-align:center;
    font-size:13px;
  }
  </style>

</head>

<body>

<?php include 'header.php'; ?>

<div class="main-container">

<?php include 'sidebar.php'; ?>

<div class="content">

<div class="form-box">

<h1 class="title">Parking Entry Portal</h1>

<p class="subtitle">Enter vehicle details to manage parking</p>

<form action="insert.php" method="post">

<input type="text" name="owner_name" placeholder="Owner Name" required>
<input type="text" name="vehicle_no" placeholder="Vehicle Number" required>
<input type="text" name="location" placeholder="Location" required>

<select name="category" required>
<option value="">Select Category</option>
<option value="2-Wheeler">2-Wheeler</option>
<option value="4-Wheeler">4-Wheeler</option>
</select>

<button type="submit">Park Vehicle</button>

</form>

<div class="footer">
Vehicle Parking Management System
</div>

</div>

</div>
</div>

</body>
</html>