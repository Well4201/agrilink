<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "b10_42642607_users";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>