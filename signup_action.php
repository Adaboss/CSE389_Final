<?php
// signup_action.php

// Step 1: Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain password (no hashing)

    // Step 2: Database connection
    $servername = "localhost";
    $username = "root"; // default XAMPP username
    $db_password = ""; // default XAMPP password
    $dbname = "user_management"; // your database name

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Step 3: Prepare and bind the SQL statement
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    
    // Prepare the SQL query
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the query
        $stmt->bind_param("sss", $name, $email, $password);
        
        // Execute the query
        if ($stmt->execute()) {
            // Success: User is registered
            echo "<p>User registered successfully!</p>";
            echo "<p><a href='signup.php'>Go back to the signup page</a></p>";
        } else {
            // If query execution fails, show the error
            echo "<p>Error executing the query: " . $stmt->error . "</p>";
        }
        
        // Close the statement
        $stmt->close();
    } else {
        // If preparation fails, show the error
        echo "<p>Error preparing the query: " . $conn->error . "</p>";
    }

    // Close the connection
    $conn->close();
} else {
    // If the form is not submitted properly
    echo "<p>Invalid request.</p>";
}
?>
