
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - NoteShare</title>
</head>
<body>
<header style='text-align: center; font-size: 24px; font-weight: bold; margin: 20px 0;'>SUNoteShared</header>
<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
<div>
    <h1>Sign Up</h1>
    <form action="signup_action.php" method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</div>
</body>
</html>
    