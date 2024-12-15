
<?php
//connectthe server to database
require 'db_connection.php';

//Getting the data signup form sending the data into database such as users name,email and password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
// Debug: Entering debug section for line 11
error_log("Debugging Line 11: " . __FILE__ . " at " . __LINE__);
        die("Please fill in all fields.");
error_log("Exiting debug section for line 11");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
// Debug: Entering debug section for line 15
error_log("Debugging Line 15: " . __FILE__ . " at " . __LINE__);
        die("Invalid email address.");
error_log("Exiting debug section for line 15");
    }
    //Hashing the password for security of the user using BCRYPT algorithm 
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
// Debug: Entering debug section for line 25
error_log("Debugging Line 25: " . __FILE__ . " at " . __LINE__);
            echo "Sign up successful!<br>";
error_log("Exiting debug section for line 25");
// Debug: Entering debug section for line 26
error_log("Debugging Line 26: " . __FILE__ . " at " . __LINE__);
            echo '<a href="login.php">Go to login</a>';
error_log("Exiting debug section for line 26");
        } else {
// Debug: Entering debug section for line 28
error_log("Debugging Line 28: " . __FILE__ . " at " . __LINE__);
            echo "Sign up failed, error: " . $stmt->error;
error_log("Exiting debug section for line 28");
        }

        $stmt->close();
    } else {
// Debug: Entering debug section for line 33
error_log("Debugging Line 33: " . __FILE__ . " at " . __LINE__);
        echo "Failed to prepare statement, error: " . $conn->error;
error_log("Exiting debug section for line 33");
    }

    $conn->close();
}
?>
    
