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
<fieldset id="title">
    <h3>BCS350 Capstone project -- Search Record -- Bradley Roff</h3>
</fieldset>
</head>
<body>
<a href="HomePage.php">Return to HomePage</a>
    <form action="search.php" method="post">
        <br>
        Search <input type="text" name="search"><br>
        Column: <select name="column">
            <option value="Id">Record ID</option>
            <option value="Title">Title</option>
            <option value="Genre">Genre</option>
            <option value="Rating">Rating</option>
            <option value="Price" selected>Price</option><!-- Default selected option -->
        </select><br>
        <!--creates  more spacific price input range if price selection is created-->
        <?php if ($_POST['column'] == 'Price'): ?>
            Price Range: $<input type="number" name="minPrice" step="10" value="0"> 
            to $<input type="number" name="maxPrice" step="10" value="10"><br>
        <?php endif; ?>
        <input type="submit" value="Search">
    </form>
    <div id="results">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = htmlspecialchars($_POST['search']);
            $column = htmlspecialchars($_POST['column']);

            $servername = "localhost";
            $username = "usersp24";
            $password = "pwdsp24";
            $db = "bcs350sp24";

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error){
                die("Connection failed: ". $conn->connect_error);
            }

            // creates search statement for price range
            $whereClause = "";
            if ($_POST['column'] == 'Price') {
                $minPrice = intval($_POST['minPrice']);
                $maxPrice = intval($_POST['maxPrice']);
                $whereClause = "AND Price BETWEEN $minPrice AND $maxPrice";
            }

            // Query statement for search
            // Replace column with the selected option from dropdown for search
            $sql = "SELECT * FROM GameStore WHERE $column LIKE '%$search%' $whereClause";

            $result = $conn->query($sql);

            // If the number of results is more than 0, fetch them, otherwise show 0 results
            if ($result->num_rows > 0){
                $recnum = 0;
                while($row = $result->fetch_assoc() ){
                    
                    echo "<br>". "Record Id: " . $row["Id"]."<br>Title: ".$row["Title"]."<br>Publisher: ".$row["Publisher"].
                    "<br>Release Date: ". $row["ReleaseDate"]."<br>Genre: ".$row["Genre"]."<br>Rating: ".$row["Rating"].
                    "<br>Description: ".$row["Description"]."<br>Price: $".$row["Price"]."<br>Current Stock: ".$row["StockQuantity"].
                    "<br>";
                }
            } else {
                echo "<br>". "0 records found";
            }

            $conn->close();
        }
        ?>
    </div>
</body>

</html>
<?php
} else {
    // User is not logged in, redirect to another page
    header("Location: login.php"); // redirects to login.php
    exit();
}
?>
