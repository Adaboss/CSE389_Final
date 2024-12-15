<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
//connection of the server to database 
require 'db_connection.php';

//Getting the data of user from html login form and from the database
//Getting the stored data of user from database and verify the login credentials

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['name'];
            header('Location: dashboard.php');
            exit;
        } else {
// Debug: Entering debug section for line 26
error_log("Debugging Line 26: " . __FILE__ . " at " . __LINE__);
            echo "Incorrect password";
error_log("Exiting debug section for line 26");
        }
    } else {
// Debug: Entering debug section for line 29
error_log("Debugging Line 29: " . __FILE__ . " at " . __LINE__);
        echo "Username not found";
error_log("Exiting debug section for line 29");
    }
    $stmt->close();
    $conn->close();
}
?>

