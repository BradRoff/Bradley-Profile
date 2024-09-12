<?php
    session_start(); 
    session_destroy();

    echo "Goodbye ". $_SESSION['username'] ; 
    destroy_session_and_data();
    die ("<p><a href='login.php'>Click here to return to log in page.</a></p>"); 
    function destroy_session_and_data()
    {
      $_SESSION = array();
      setcookie(session_name(), '', time() - 2592000, '/');
      session_destroy();
    }
?>
