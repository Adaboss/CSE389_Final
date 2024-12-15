
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - NoteShare</title>
</head>
<style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            font-size: 28px;
            color: #6a1b9a;
            margin-bottom: 20px;
        }

        .container form {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .container input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container button {
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #6a1b9a;
            color: white;
            cursor: pointer;
        }

        .container button:hover {
            background-color: #501c73;
        }

        .container a {
            margin-top: 10px;
            color: #6a1b9a;
            text-decoration: none;
        }

        .container a:hover {
            text-decoration: underline;
        }
    </style>
<body>
<header style='text-align: center; font-size: 24px; font-weight: bold; margin: 20px 0;'>SUNoteShare</header>
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
    