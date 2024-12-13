
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$upload_dir = 'uploads/';

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file_name = basename($_FILES['file']['name']);
    $file_name = preg_replace('/[^A-Za-z0-9.\-_]/', '', $file_name); 
    $target_file = $upload_dir . uniqid('file_', true) . '.' . pathinfo($file_name, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $message = "File uploaded successfully: " . htmlspecialchars($file_name);
    } else {
        $message = "File upload failed.";
    }
}

if (isset($_GET['download'])) {
    $file_to_download = realpath($upload_dir . basename($_GET['download']));
    if (strpos($file_to_download, realpath($upload_dir)) === 0 && file_exists($file_to_download)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_to_download) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_to_download));
        readfile($file_to_download);
        exit;
    } else {
        $message = "File not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage - NoteShare</title>
</head>
<body>
<header style='text-align: center; font-size: 24px; font-weight: bold; margin: 20px 0;'>SUNoteShared</header>
<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
<div>

<?php
// Debug: Entering debug section for line 51
error_log("Debugging Line 51: " . __FILE__ . " at " . __LINE__);
?>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<?php
error_log("Exiting debug section for line 51");

if (!empty($message)) {
    // Debug: Entering debug section for line 54
    error_log("Debugging Line 54: " . __FILE__ . " at " . __LINE__);
    echo "<p>" . htmlspecialchars($message) . "</p>";
    error_log("Exiting debug section for line 54");
}
?>

    <h2>Upload File</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload File</button>
    </form>

    <h2>File List</h2>
    <ul>
        <?php
        $files = array_diff(scandir($upload_dir), ['.', '..']);
        foreach ($files as $file) {
// Debug: Entering debug section for line 68
error_log("Debugging Line 68: " . __FILE__ . " at " . __LINE__);
            echo "<li><a href='?download=" . urlencode($file) . "'>" . htmlspecialchars($file) . "</a></li>";
error_log("Exiting debug section for line 68");
        }
        ?>
    </ul>

    <a href="logout.php">Logout</a>
</div>
</div>
</body>
</html>
    