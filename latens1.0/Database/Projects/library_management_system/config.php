<?php
$host = 'localhost';        // Database host
$db = 'librarysystem_db';   // Database name
$user = 'root';             // MySQL username (default for XAMPP)
$pass = '';                 // MySQL password (default is empty for XAMPP)

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
