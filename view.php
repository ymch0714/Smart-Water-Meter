<!DOCTYPE html>
<html>
<head>
<title>
Smart Watermeter Data
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>

<div class="topnav">
  <a href="/">Home</a>
  <a class="active" href="/view.php">Log</a>
  <a href="/about.html">About</a>
</div>

<style>
#c4ytable {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
 
#c4ytable td, #c4ytable th {
    border: 2px solid #ddd;
    padding: 10px;
}
 
#c4ytable tr:nth-child(even){background-color: #f2f2f2;}
 
#c4ytable tr:hover {background-color: #ddd;}
 
#c4ytable th {
    padding-left: 16px;
    padding-top: 16px;
    padding-right: 16px;
    padding-bottom: 16px;
    text-align: left;
    background-color: #00A8A9;
    color: white;
}
</style>
 
<?php
    //Connect to database and create table
    $servername = "localhost";
    $username = "USERNAME";
    $password = "PASSWORD";
    $dbname = "DBNAME";
 
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
?> 
 
 
<div id="cards" class="cards">
 
<?php 
    $sql = "SELECT * FROM TABLENAME ORDER BY id DESC";
    if ($result=mysqli_query($conn,$sql))
    {
      // Fetch one and one row
      echo "<TABLE id='c4ytable'>";
      echo "<TR><TH>Station</TH><TH>Data</TH><TH>Date</TH><TH>Time</TH></TR>";
      while ($row=mysqli_fetch_row($result))
      {
        echo "<TR>";
	echo "<TD>".$row[1]."</TD>";
        echo "<TD>".$row[2]."</TD>";
        echo "<TD>".$row[4]."</TD>";
        echo "<TD>".$row[5]."</TD>";

        echo "</TR>";
      }
      echo "</TABLE>";
      // Free result set
      mysqli_free_result($result);
    }
 
    mysqli_close($conn);
?>
</body>
</html>
