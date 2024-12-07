<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include database connection file
require_once 'db_connection.php'; // Ensure this file contains the correct database connection setup

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        die('Please fill in both fields.');
    }

    // Prepare SQL query to check the user by the `name` column
    $sql = "SELECT * FROM users WHERE name = ? LIMIT 1"; // Replace 'users' with your actual table name
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("s", $username);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if a user is found
        if ($result->num_rows > 0) {
            // Fetch the user data
            $user = $result->fetch_assoc();

            // Compare passwords (assuming plain text for simplicity)
            if ($password === $user['password']) { // Use password hashing in production for security
                // Start session
                session_start();

                // Store user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['name']; // Using `name` here

                // Redirect to dashboard
                header("Location: dashboard.php"); // Change this to your desired page
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Invalid username.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error in query: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
