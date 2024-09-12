<?php
// Start session
session_start();

// Check if valid user is logged in
if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
?>
<html>
    <!--Setup the inital database for table, creates data for table if the table dosn't exist
    copy of hw4setup  
        !-->
<head>
    <fieldset id = "title">
    <title>BCS350 Capstone project -- database reset -- Bradley Roff</title> 
    </fieldset>
</head>
<?php
// Connect to the database using the MySQLi class
require_once 'cap_login.php';
$conn = new mysqli($host, $user, $pass, $data);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create a table named student to store student information, deletes student table if exists.
$query = "DROP TABLE IF EXISTS GameStore";
if ($conn->query($query) === TRUE) {
    echo "GameStore Table dropped successfully <br>";
} else {
    echo "Error dropping table: " . $conn->error;
}

$query = "CREATE TABLE IF NOT EXISTS GameStore (
              Id INT PRIMARY KEY AUTO_INCREMENT,
              Title VARCHAR(100) NOT NULL,
              Publisher VARCHAR(100) DEFAULT 'Unknown',
              ReleaseDate date DEFAULT Null,
              Genre VARCHAR(50) DEFAULT 'Unknown',
              Rating DECIMAL(3,1) DEFAULT 0.0,
              Description TEXT ,
              Price DECIMAL(10,2) DEFAULT 0.0,
              StockQuantity Int DEFAULT 0
          )";
if ($conn->query($query) === TRUE) {
    echo "GameStore Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error."<br>";
}


// Prepare INSERT statement it this isnt here the quires happen simutaniusly and fourm an error.
$stmt = $conn->prepare("INSERT INTO GameStore (Title, Publisher, ReleaseDate, Genre, Rating, Description, Price, StockQuantity) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}
//create a multi array to be binded to an insert satment for standard data
$valuesArray = array(
    array('The Witcher 3: Wild Hunt', 'CD Projekt', '2015-05-19', 'Action-RPG', 9.3, 'An open-world action RPG set in a fantasy universe, featuring a vast open world, engaging storylines, and immersive gameplay.', 29.99, 100),
    array('Baldur\'s Gate 3', 'Larian Studios', '2023-08-03', 'RPG', 9.6, 'A choose-your-own-adventure RPG set in the DND universe from the creators of Divinity: Original Sin 2.', 59.99, 80),
    array('Mario Kart 8 Deluxe', 'Nintendo', '2017-04-28', 'Racing', 9.2, 'A port of the classic Mario Kart 8 on Switch including its previous DLCs!', 39.99, 60),
    array('Hades', 'Supergiant Games', '2020-09-17', 'Action Rougelike', 9.3, 'An action rougelike where you fight your way out of the underworld, making friends with many well-known Greek gods on the way.', 24.99, 20),
    array('Hollow Knight', 'Team Cherry', '2017-02-24', 'Metroidvania', 9.5, 'Explore twisting caverns, battle tainted creatures, and befriend bizarre bugs, all in a classic, hand-drawn 2D style.', 14.99, 20),
    array('Grand Theft Auto V', 'Rockstar Games', '2013-09-17', 'Action-Adventure', 9.5, 'An action-adventure game set in an open-world environment, allowing players to freely roam the fictional state of San Andreas.', 39.99, 150),
    array('The Legend of Zelda: Breath of the Wild', 'Nintendo', '2017-03-03', 'Action-Adventure', 9.7, 'An action-adventure game set in a large open world, featuring exploration, puzzle-solving, and combat elements.', 49.99, 80),
    array('Red Dead Redemption 2', 'Rockstar Games', '2018-10-26', 'Action-Adventure', 9.8, 'An action-adventure game set in the American Old West, featuring a vast open world, immersive narrative, and realistic gameplay mechanics.', 49.99, 120),
    array('Minecraft', 'Mojang Studios', '2009-05-17', 'Sandbox', 9.0, 'A sandbox video game that allows players to build and explore virtual worlds made up of blocks.', 19.99, 200)
);  
$index=0;
// Bind parameters and execute INSERT statement for each array
foreach ($valuesArray as $values) {
    // Bind parameters
   
    $Title = $values[0];
    $Publisher = $values[1];
    $ReleaseDate = $values[2];
    $Genre = $values[3];
    $Rating = $values[4];
    $Description = $values[5];
    $Price = $values[6];
    $StockQuantity = $values[7];
    $index++;
    $stmt->bind_param('ssssdssi', $Title, $Publisher, $ReleaseDate, $Genre, $Rating, $Description, 
    $Price, $StockQuantity);

    // Execute INSERT statement
    if ($stmt->execute() === TRUE) {
        echo "Record $index inserted successfull<br>";
    } else {
        echo "Error: " . $stmt->error."<br>";
    }
}

//create table users to store user info
$query = "CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(32) NOT NULL PRIMARY KEY,
    email VARCHAR(32) NOT NULL,
    password VARCHAR(225) NOT NULL
    
)";
if ($conn->query($query) === TRUE) {
echo "Users Table created successfully<br>";
} else {
echo "Error creating table: " . $conn->error;
}

// Close statement
$stmt->close();
$conn->close();
?>
=

 
</style>
<p>Click the <a href="HomePage.php">Home Page</a> for a short cut to the Homepage</p>
</html>
<?php
} else {
    // User is not logged in, redirect to another page
    header("Location: login.php"); // redirects to login.php
    exit();
}
?>