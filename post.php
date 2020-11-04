<?php
    //Set up login for phpmyadmin database
    $hostName = "localhost";
    $userName = "USERNAME";
    $password = "PASSWORD";
    $dbName = "DATABASE";

    $conn = new mysqli($hostName, $userName, $password, $dbName);

    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    //Get Date and Time
    date_default_timezone_set('Pacific/Auckland');
    $d = date("Y-m-d");
    $t = date("H:i:s");

    //Post Received data to phpmyadmin database
    if(!empty($_POST['status']) && !empty($_POST['station']))
        {
    	$status = $_POST['status'];
    	$station = $_POST['station'];

	    $sql = "INSERT INTO logs (station, status, Date, Time)
		
		VALUES ('".$station."', '".$status."', '".$d."', '".$t."')";

		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


	$conn->close();
?>