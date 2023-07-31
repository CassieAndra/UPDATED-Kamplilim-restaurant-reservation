<?php
	$fullName = $_POST['fullname'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$password = $_POST['password'];
	

	// Database connection
	$conn = new mysqli('localhost','root','','loginsystem');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into user(fullName, email, contact, password) values(?, ?, ?, ?)");
		$stmt->bind_param("ssis", $fullName, $email, $contact, $password);
		$execval = $stmt->execute();
		
		echo "You are successfully registered";
		$stmt->close();
		$conn->close();
	}
?>