<?php
session_start();

// Directory for uploaded files
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $target_file = $upload_dir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        $upload_message = "File uploaded successfully!";
    } else {
        $upload_message = "Failed to upload file.";
    }
}
?>
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
    <h1>Welcome, <?php echo $_SESSION['username'] ?? 'User'; ?>!</h1>
    <div class="button-container">
      <button onclick="openFileUpload()">Upload New Note</button>
      <button>View All Notes</button>
      <button>Search Notes</button>
      <button>View Shared Notes</button>
    </div>

    <!-- Display upload status -->
    <?php if (isset($upload_message)) { ?>
      <p><?php echo htmlspecialchars($upload_message); ?></p>
    <?php } ?>

    <!-- Recent Notes -->
    <div class="recent-notes">
      <h3>Recent Notes:</h3>
      <ul>
        <?php
          // List all files in the upload directory
          $files = array_diff(scandir($upload_dir), ['.', '..']);
          foreach ($files as $file) {
              $file_url = htmlspecialchars($upload_dir . $file);
	      echo "<li><a href='$file_url' download>" . htmlspecialchars($file) . "</a></li>";

          }
        ?>
      </ul>
    </div>
  </div>

  <!-- Hidden file upload form -->
  <form id="fileUploadForm" method="POST" enctype="multipart/form-data" style="display: none;">
    <input type="file" name="file" id="fileInput" onchange="uploadFile()">
  </form>

  <script>
    // Open the file dialog
    function openFileUpload() {
      document.getElementById('fileInput').click();
    }

    // Submit the form when a file is selected
    function uploadFile() {
      document.getElementById('fileUploadForm').submit();
    }
  </script>
</body>
</html>
