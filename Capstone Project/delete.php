<?php
// Start session
session_start();

// Check if valid user is logged in
if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
?>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <body>
        <head>
<fieldset id = "title">
    <h3>BCS350 Capstone project -- Delete record -- Bradley Roff</h3> 
</fieldset>
</head>
<?php // delete.php
 require_once 'cap_login.php';
 $conn = new mysqli($host, $user, $pass, $data);

// Function to sanitize user input
function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}

 if ($conn->connect_error) die("Fatal Error");

  if (isset($_POST['delete']) && isset($_POST['Id']))
  {
    $Id   = get_post($conn, 'Id');
    $query  = "DELETE FROM GameStore WHERE Id='$Id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed<br><br>";
  }
  
 

  $query  = "SELECT * FROM GameStore ORDER BY Id DESC";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed");

  $rows = $result->num_rows;

  //sanitizes given
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_NUM);

    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    $r3 = htmlspecialchars($row[3]);
    $r4 = htmlspecialchars($row[4]);
    $r5 = htmlspecialchars($row[5]);
    $r6 = htmlspecialchars($row[6]);
    $r7 = htmlspecialchars($row[7]);
    $r8 = htmlspecialchars($row[8]);
    

    //code seting up delete records 
    
    echo "<div style='white-space: pre-wrap;'>";
    echo <<<_END
    
Record number: $r0
Game Title: $r1
Publisher: $r2
Release Date: $r3
Genre: $r4
Rating: $r5
Description: <span style="word-wrap: break-word; max-width: 500px;">$r6</span>Price: $$r7
Current Stock: $r8<form action='delete.php' method='post'> <input type='hidden' name='delete' value='yes'><input type='hidden' name='Id' value='$r0'>
<input type='submit' value='DELETE RECORD'></form>
_END;
  }

  $result->close();
  $conn->close();

} else {
    // User is not logged in, redirect to another page
    header("Location: login.php"); // redirects to login.php
    exit();
}
?>
</body>
</html>
