<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
<body>
  
<head>
<p>Welcome to Log-In page</p>
</head>
<?php 
  require_once 'cap_login.php';
  $conn = new mysqli($host, $user, $pass, $data);


  if ($conn->connect_error) die("Fatal Error");


 
  if (isset($_SERVER['PHP_AUTH_USER']) &&
      isset($_SERVER['PHP_AUTH_PW']))
  {
    $un_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_USER']);
    $pw_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_PW']);
    $query   = "SELECT * FROM users WHERE Username='$un_temp'";
    $result  = $conn->query($query);

    if (!$result) die("User not found");
    elseif ($result->num_rows)
    {
      $row = $result->fetch_array(MYSQLI_NUM);

      $result->close();

      if (password_verify($pw_temp, $row[2]))
      {
        session_start();
        $_SESSION['username'] = $row[0];
       
        echo htmlspecialchars("Welcome $row[0]!");
        die ("<p><a href='homepage.php'>Click here to continue</a></p>"); //leads to continue.php
      }
      else die("Invalid username/password combination");
    }
    else die("Invalid username/password combination");
  }
  else
  {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    die ("Please enter your username and password");
  }

  $conn->close();

  function mysql_entities_fix_string($conn, $string)
  {
    return htmlentities(mysql_fix_string($conn, $string));
  }	

  function mysql_fix_string($conn, $string)
  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $conn->real_escape_string($string);
  }
?>

</body>

    </html>