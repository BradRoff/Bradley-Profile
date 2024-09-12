<?php
// Start session
session_start();

// Check if valid user is logged in
if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
<head>
    <title>BCS350 Capstone project -- Homepage -- Bradley Roff</title>
</head>
<body>
    <fieldset id="title">
        <h2>BCS350 Capstone project -- Homepage -- Bradley Roff</h2> 
    </fieldset>

    <!-- Welcomes user-->
    <h2>Welcome <?php echo $username; ?> to my capstone project. </br>Please choose an option:</h2>
   
    <!-- table of links leading to related pages -->
    <table style="width:100%">
        <tr>
            <td><a href="list.php">List Database</a></td>
            <td><a href="add.php">Add a new record</a></td>
            <td><a href="search.php">Search database</a></td>
        </tr>
        <tr>        
            <td><a href="delete.php">Delete A record</a></td>
            <td><a href="setupDB.php">Reset Database to original values</a></td>
            <td><a href="Logout.php">Log out</a></td>
        </tr>
    </table>
</body>
</html>
<?php
} else {
    // User is not logged in, redirect to another page
    header("Location: login.php"); // redirects to login.php
    exit();
}
?>