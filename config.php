<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "admin_id";

$conn = new mysqli ($host, $user, $password, $database);
if ($conn->connect_error) {
    die("connection failed:". $conn->connect_error);
}

?>
