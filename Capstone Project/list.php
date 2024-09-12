<?php
// Start session
session_start();

// Check if valid user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
?>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
<body>
<head>
<fieldset id = "title">
    <h3>BCS350 Capstone project -- database list -- Bradley Roff</h3> 
</fieldset>
</head>
<a href="HomePage.php">Return to HomePage</a>
<div id = "results">
<?php

require_once 'cap_login.php';
$conn = new mysqli($host, $user, $pass, $data);
echo $username;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Query to recive all records form student
$sql = "SELECT * FROM GameStore";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data to row while availible
   
    while ($row = $result->fetch_assoc()) {

        echo "<br>Record ID: " . $row["Id"] . "<br>";
        echo "Game Title: " . $row["Title"] . "<br>";
        echo "Publisher: " . $row["Publisher"] . "<br>";
        echo "Release Date: " . $row["ReleaseDate"] . "<br>";
        echo "Genre: " . $row["Genre"] . "<br>";
        echo "Rating: " . $row["Rating"] . "<br>";
        echo "Description: " . $row["Description"] . "<br>";
        echo "Price: $" . $row["Price"] . "<br>";
        echo "Current Stock: " . $row["StockQuantity"] . "<br>";
        

    }
} else {
    //if no data is found, show message
    echo "0 records in database.";
}


$conn->close();
?>
</div>
<style>
  
    </style>
</body>
</html>
<?php
} 
else {
    // User is not logged in, redirect to another page
    header("Location: login.php"); // redirects to login.php
    exit();
}
?>