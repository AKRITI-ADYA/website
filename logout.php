<?php
// Start the session to access any session variables
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page (index.php)
header("Location: index.php");
exit();
?>