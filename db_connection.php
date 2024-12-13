
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
// Debug: Entering debug section for line 11
error_log("Debugging Line 11: " . __FILE__ . " at " . __LINE__);
    die("Database connection failed: " . $conn->connect_error);
error_log("Exiting debug section for line 11");
}
?>
    