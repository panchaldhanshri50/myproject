<?php
$host = "localhost";
$username = "root";
$password = "ready1234";
$dbname = "common_question_finder";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
