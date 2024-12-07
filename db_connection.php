<?php
// Database connection settings
$servername = "localhost"; // Usually "localhost" on XAMPP
$username = "root";        // Default username for XAMPP
$password = "";            // Default password for XAMPP (leave empty)
$dbname = "user_management";       // Replace this with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
