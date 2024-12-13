
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuNoteShared - Login</title>
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
</head>
<body>
    <div class="container">
        <h1>SuNoteShared</h1>
        <form action="login_action.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here.</a></p>
    </div>
</body>
</html>
