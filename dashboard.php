


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NoteShare Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 250px;
      background-color: #007bff;
      color: #fff;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    .sidebar h2 {
      margin-bottom: 20px;
      font-size: 22px;
    }

    .sidebar a {
      text-decoration: none;
      color: #fff;
      margin: 10px 0;
      font-size: 18px;
    }

    .sidebar a:hover {
      text-decoration: underline;
    }

    .dashboard {
      flex: 1;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .dashboard h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .button-container {
      margin-bottom: 20px;
    }

    .button-container button {
      padding: 10px 20px;
      margin-right: 10px;
      font-size: 16px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .button-container button:hover {
      background-color: #0056b3;
    }

    .recent-notes {
      margin-top: 20px;
    }

    .recent-notes h3 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .recent-notes ul {
      list-style-type: none;
      padding: 0;
    }

    .recent-notes li {
      background-color: #f4f4f4;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 4px;
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>NoteShare</h2>
    <a href="#">Dashboard</a>
    <a href="#">My Notes</a>
    <a href="#">Shared Notes</a>
    <a href="#">Profile</a>
    <a href="#">Settings</a>
  </div>

  <div class="dashboard">
    <h1>
        <?php
            session_start();
            echo "Welcome " . $_SESSION['username'] . "!";  
        ?>
    </h1>
    <div class="button-container">
      <button>Create New Note</button>
      <button>View All Notes</button>
      <button>Search Notes</button>
      <button>View Shared Notes</button>
    </div>
    <div class="recent-notes">
      <h3>Recent Notes:</h3>
      <ul>
        <li>Note Title 1 (Modified: Date)</li>
        <li>Note Title 2 (Modified: Date)</li>
      </ul>
    </div>
  </div>
</body>
</html>